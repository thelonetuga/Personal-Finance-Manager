<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Associate extends Model
{
    use Notifiable;
    use SoftDeletes;
    public $timestamps = false;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */


    protected $fillable = [
        'main_user_id, associated_user_id, created_at',
    ];

    public function associate(){
        return  $this->belongsTo('App\User', 'main_user_id');
    }

    public function associateOf(){
        return  $this->hasMany('App\User', 'associated_user_id');
    }
}
