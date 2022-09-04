<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','parent_id','user_id'];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    public function categories(){
        return $this->hasMany(self::class,'parent_id','id');
    }

    public function parent_category(){
        return $this->belongsTo(self::class,'parent_id','id');
    }


}
