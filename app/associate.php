<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class associate extends Model
{
    use Notifiable;


    public function associate(){
        return  $this->belongsTo('App\User', 'main_user_id');
    }

    public function associateOf(){
        return  $this->hasMany('App\User', 'associated_user_id');
    }
}
