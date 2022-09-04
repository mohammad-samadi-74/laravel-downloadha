<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','price','views','likes','dislikes','wallpaper','inventory','tags'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function images(){
        return $this->hasMany(ProductGallery::class);
    }

    public function hasCategory($category){
        return in_array($category->id,$this->categories()->pluck('id')->toArray()) || !empty(array_intersect($category->categories()->pluck('id')->toArray(),$this->categories()->pluck('id')->toArray()));
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function attributes(){
        return $this->belongsToMany(Attribute::class)->withPivot(['value_id']);
    }

}
