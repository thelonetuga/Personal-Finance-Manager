<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
     use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone', 'profile_photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



   public function isAdmin()
    {
        switch ($this->admin) {
            case 0:
                return 'NORMAL';
            case 1:
                return 'ADMIN';
        }
    }
    
    public function isBlocked()
    {
        if ($this->blocked) {
            return 'true';
        }
        return 'false';
    }

    public function toggleDemote()
    {
        if ($this->admin) {
            $this->admin = 0;
        } else {
            $this->admin = 1;
        }
    }

     public function toggleBlock()
    {
        if ($this->blocked) {
            $this->blocked = 0;
        } else {
            $this->blocked = 1;
        }
    }

    public function associateIs($id){
       $user = User::findOrFail($id);
       return $this->associateOf->contains($user);
    }

    public function associateOf(){
        return  $this->belongsToMany('App\User', 'associate_members', 'associated_user_id', 'main_user_id');
    }

    public function associate(){
        return  $this->belongsToMany('App\User', 'associate_members', 'main_user_id', 'associated_user_id');
    }



}
