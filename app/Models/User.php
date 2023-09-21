<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasLocalePreference
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
        'password',
    ];
     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id');
    }
    public function submissions(){
        return $this->hasMany(Submission::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    //MANY-TO-MANY
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class, 'classroom_user');
    }
// relation between user and it's own classroom
    public function createdClassroom(){
        return $this->hasMany(Classroom::class,'user_id');
    }

    public function classworks(){
        return $this->belongsToMany(Classwork::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function routeNotificationForVonage($driver, $notification = null)
    {
        return "972592244943";
    }
    public function preferredLocale(){
        return $this->profile->locale ?? "";
    }
}

