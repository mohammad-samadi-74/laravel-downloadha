<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostGallery extends Model
{
    use HasFactory;

    protected $fillable = ['image','post_id'];

    protected $table = 'postgallery';

    public $timestamps = false;

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
