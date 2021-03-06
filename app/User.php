<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GrahamCampbell\Markdown\Facades\Markdown;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable,LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function gravatar() {
        $email = $this->email;
        $default = "https://upload.wikimedia.org/wikipedia/commons/e/e4/Elliot_Grieveson.png";
        $size = 100;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getBioHtmlAttribute() {
        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : NULL; 
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
