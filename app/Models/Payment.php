<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['address_id','status','resNumber','post_method','payment_method','post_date'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
