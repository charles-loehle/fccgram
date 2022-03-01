<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];//everything passed in is ok

    public function user() {
      return $this->belongsTo(User::class);
    }

    // a Post can have many Users that like it 
    public function likers() {
      return $this->belongsToMany(User::class);
    }
}
