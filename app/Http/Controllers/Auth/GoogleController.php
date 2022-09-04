<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    use TwoFactorAuthenticate;

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleLoginCallback(Request $request){
        try {

            $googleUser = Socialite::driver('google')->user();

            if($user = User::where('email',$googleUser->email)->first()){

                // two factor auth login
                if($user->is_tfa_enabled()){
                    return $this->loggedIn($request, $user);
                }

                auth()->loginUsingId($user->id);
            }else{
                $newUser = User::create([
                    'name'=>$googleUser->name,
                    'email'=>$googleUser->email,
                    'password'=> bcrypt(Str::random())
                ]);
                auth()->loginUsingId($newUser->id);
            }
            alert()->success('شما با موفقیت وارد سایت شدید.');
            return redirect(route('home'));

        }catch(\Exception $e){
            alert()->error('ورود با گوگل موفقیت آمیز نبود.');
            return redirect(route('login'));
        }
    }

}
