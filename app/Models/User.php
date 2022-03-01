<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Automatically Creating A Profile Using Model Events
    protected static function boot() {
      parent::boot();
      static::created(function($user){
        $user->profile()->create([
          'title' => $user->username,
        ]);
      });
    }

    public function posts() {
      return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    // a user can follow may Profiles
    public function following() {
      return $this->belongsToMany(Profile::class);
    }

    // a user can like many Posts
    public function like() {
      return $this->belongsToMany(Post::class);
    }

    public function profile() {
      return $this->hasOne(Profile::class);
    }
}
