<?php


namespace App\Http\Controllers\Auth;


use App\Models\User;
use App\Notifications\ActiveCodeEmailNotification;
use App\Notifications\ActiveCodeSmsNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

trait TwoFactorAuthenticate
{
    public function loggedIn(Request $request, $user)
    {
        if ($user->is_tfa_enabled()){
            auth()->logout();
        }

        $request->session()->flash('auth',[
            'user_id'=>$user->id,
            'using_sms' => false,
            'using_email' => false,
            'remember' => $request->has('remember')
        ]);

        if ($user->is_tfa_sms()){
            $user->makeValidationCode();
            $request->session()->push('auth.using_sms',true);
            return redirect(route('two_factor_auth_token'));
        }

        if ($user->is_tfa_email()){
            $user->makeValidationCode();
            $request->session()->push('auth.using_email',true);
            return redirect(route('two_factor_auth_token'));
        }

        return false;
    }

    public function two_factor_auth_token(Request $request){
        //seo
        $this->seo()->setTitle('مرجع دانلود برنامه , فیلم و سریال');

        if (! $request->hasSession('auth')){
            return redirect(route('login'));
        }


        $user = User::findOrFail(session('auth.user_id'));

         if ($request->session()->get('auth.using_sms') != false){
             $user->notify(new ActiveCodeSmsNotification($user->code->code));
        }

        if ($request->session()->get('auth.using_email') != false){
            $user->notify(new ActiveCodeEmailNotification($user->code->code));
        }

        $request->session()->reflash();

        return view('auth.twoFactorAuthToken');
    }

    public function two_factor_auth_confirm(Request $request){
        if (! $request->hasSession('auth')){
            return redirect(route('login'));
        }



        $user = User::findOrfail($request->session()->get('auth.user_id'));
        $code = $request->validate(['token'=>'required']);

        if($code['token'] !== $user->code->code){
            alert()->error('کد وارد شده صحیح نمی باشد.');
            return redirect(route('login'));
        }

        if ($user->code->expired_at < Carbon::now()){
            alert()->error('تاریخ انقضای کد وارد شده گذشته است.');
            return redirect(route('login'));
        }

        auth()->loginUsingId($user->id);
        $user->code()->delete();
        alert()->success('شما با موفقیت وارد شدید.');
        return redirect(route('home'));
    }
}
