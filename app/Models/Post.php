<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title','type','first_content','second_content','third_content','info','system_l','system_b','files_setup','files_info','tags','views','likes','dislikes','downloads','download','wallpaper'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function hasCategory($category){
        return in_array($category->id,$this->categories()->pluck('id')->toArray()) || !empty(array_intersect($category->categories()->pluck('id')->toArray(),$this->categories()->pluck('id')->toArray()));
    }

    public function images(){
        return $this->hasMany(PostGallery::class);
    }

    public function icon(){
        return $this->hasOne(PostIcon::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    protected function search_parent_category_posts($parentCategoryName)
    {
        $posts = $this->query();
        $id_array = Category::where('parent_id',Category::where('name',$parentCategoryName)->first()->id)->get()->map(function($cat){
            return $cat->posts()->get()->pluck('id');
        })->collapse();
        $posts = $posts->whereIn('id',$id_array);
        return $posts;
    }

}
