<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostIcon extends Model
{
    use HasFactory;

    protected $fillable = ['icon','caption','content','post_id'];

    protected $table = 'postIcon';

    public $timestamps = false;

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
