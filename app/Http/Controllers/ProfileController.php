<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\ValidationCode;
use App\Notifications\ActiveCodeEmailNotification;
use App\Notifications\ActiveCodeSmsNotification;
use App\Notifications\GhasedakChannel;
use App\Notifications\Sendsms;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ProfileController extends Controller
{
    public function profile($tab = null)
    {
        //seo
        $this->seo()->setTitle('پروفایل');

        $tab = in_array($tab, range(1, 5)) ? $tab : 1;
        return view('profile.profile', compact('tab'));
    }

    public function editProfile()
    {
        //seo
        $this->seo()->setTitle('ویرایش پروفایل');
        return view('profile.edit');
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $validData = $request->validated();
        auth()->user()->update($validData);
        alert()->success('ویرایش پروفایل با موفقیت انجام شد.');
        return redirect(route('profile'));
    }

    public function two_factor_auth_form()
    {
        if (session('phone_number'))
            return view('profile.twoFactorAuth.twoFactorPhoneForm');

        elseif (session('email'))
            return view('profile.twoFactorAuth.twoFactorEmailForm');
    }

    public function active_two_factor_auth(Request $request)
    {
        //seo
        $this->seo()->setTitle('فرم تایید احراز هویت دومرحله ای');

        $user = auth()->user();

        $validator = Validator::make($request->all(),[
            'type'=>['required','in:off,sms,email'],
            'phone_number' => ['required_with:type,sms', 'regex:/(09)[0-9]{9}/', 'size:11', Rule::unique('users', 'phone_number')->ignore($user->id)],
            'email' => [ 'required_with:type,email', 'email', Rule::unique('users', 'email')->ignore($user->id)]
        ]);

        if ($validator->fails()){
            return redirect('profile/2')->withErrors($validator);
        }

        if ($request['type'] === 'sms' && $user->is_tfa_sms() && isset($request['phone_number']) && $user->phone_number === $request['phone_number'] && $user->phone_verified_at){
            alert()->warning('احراز هویت دو مرحله ای برای این شماره قبلا فعال شده.');
            return redirect('/profile/2');
        }

        if ($request['type'] === 'email' && $user->is_tfa_email() && isset($request['email']) && $user->email === $request['email'] && $user->email_verified_at){
            alert()->warning('احراز هویت دو مرحله ای برای این ایمیل قبلا فعال شده.');
            return redirect('/profile/2');
        }

        switch ($type = $request['type']) {
            case 'sms' :
            {
                $code = $user->makeValidationCode();
                $this->set_auth_session('phone_number', $request['phone_number']);
                $user->notify(new ActiveCodeSmsNotification($code));

                return view('profile.twoFactorAuth.twoFactorPhoneForm');break;
            }
            case 'email' :
            {
                $code = $user->makeValidationCode();
                $this->set_auth_session('email', $request['email']);
                $user->notify(new ActiveCodeEmailNotification($code));

                return view('profile.twoFactorAuth.twoFactorEmailForm');break;
            }
            default :
            {
                $user->update(['two_factor_auth' => 'off']);
                alert()->success('احراز هویت دو مرحله ای با موفقیت غیر فعال شد.');
            }
        }
        return redirect(route('profile', ['tab' => 2]));
    }

    public function confirmTwoFactorAuth(Request $request)
    {
        $user = auth()->user();
        $validData = $request->validate([
            'token' => 'required|exists:validation_codes,code',
            'g-recaptcha-response'=>['required',new Recaptcha]
            ],['g-recaptcha-response.required'=>'لطفا تیک من ربات نیستم را بزنید.']);
        $code = ValidationCode::where('code', $validData['token'])->first();

        if ($code->user->id !== $user->id) {
            alert()->error('کد وارد شده اشتباه است.');
            return redirect(url('profile/2'));
        } elseif ($code->expired_at < Carbon::now()) {
            alert()->error('کد تایید منقضی شده است.لطفا مجددا کد تایید دریافت کنید.');
            return redirect(url('profile/2'));
        } else {
            $data=[];
            if (session('phone_number')) {
                $type = 'sms';  $key = 'phone_number';  $session = session('phone_number');
                $data['phone_verified_at'] = Carbon::now();

            } elseif (session('email')) {
                $key = $type = 'email';   $session = session('email');
                $data['email_verified_at'] = Carbon::now();
            } else {
                alert()->error("لطفا مجددا تلاش کنید.ایمیل یا شماره وارد شده معتبر نیست.");
                return redirect(url('profile/2'));
            }
            $data['two_factor_auth'] = $type;   $data[$key] = $session;
            alert()->success("احراز هویت دومرحله ای با {$type} با موفقیت فعال شد.");
            $user->update($data);
            session()->forget(['phone_number', 'email']);
            $user->code->delete();
            return redirect(url('profile/2'));
        }
    }

    protected function set_auth_session($key, $value)
    {
        if ($key === 'phone_number')
            session()->forget('email');
        if ($key === 'email')
            session()->forget('phone_number');
        session([$key => $value]);
    }
}


