<?php

namespace App\Models;

use App\Notifications\RessetPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password','phone_number','two_factor_auth','is_superuser','is_staff','phone_verified_at','email_verified_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RessetPassword($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function rules(){
        return $this->belongsToMany(Rule::class);
    }

    public function hasPermission($permission){
        return ($this->permissions->contains('name',$permission->name) || $this->hasRule($permission->rules));
    }

    public function hasRule($rules){
        return !! $rules->intersect($this->rules)->all();
    }

    public function code()
    {
        return $this->hasOne(ValidationCode::class);
    }

    public function is_tfa_enabled(){
        return $this->two_factor_auth !== 'off';
    }

    public function is_tfa_sms(){
        return $this->two_factor_auth === 'sms';
    }

    public function is_tfa_email(){
        return $this->two_factor_auth === 'email';
    }

    public function makeValidationCode($length = 16, $expired_minutes = 1)
    {
        if (!$this->code || $this->code()->first()->expired_at < Carbon::now()) {
            $this->code()->delete();
            $code = Str::random($length);
            $code = $this->code()->save(new ValidationCode(['code' => $code, 'expired_at' => Carbon::now()->addMinutes($expired_minutes)]));
        }
        return $code->code ?? $this->code->code;

    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }

}
