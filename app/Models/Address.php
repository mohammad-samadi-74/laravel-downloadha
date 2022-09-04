<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['state','city','address','phone','cellphone_number'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

}
