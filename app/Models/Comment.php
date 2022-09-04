<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment','parent_id','user_id','approved'];

    public function commentable(){
        return $this->morphTo();
    }

    public function comments(){
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
