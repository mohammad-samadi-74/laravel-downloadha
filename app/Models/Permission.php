<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name','label'];

    public function rules(){
        return $this->belongsToMany(Rule::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
