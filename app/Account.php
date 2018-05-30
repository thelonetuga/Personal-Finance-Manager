<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use DB;

class Account extends Model
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
        'id','date', 'start_balance', 'description', 'code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'code' , 'remember_token',
    ];

    public function typeToStr()
    {
        switch ($this->account_type_id) {
            case 0:
              return 'Unknown';
            case 1:
              return DB::table ('account_types')->where('id','=', 1 )->value('name');
            case 2:
              return  DB::table ('account_types')->where('id','=', 2 )->value('name');
            case 3:
                return  DB::table ('account_types')->where('id','=', 3 )->value('name');
            case 4:
                return  DB::table ('account_types')->where('id','=', 4 )->value('name');
            case 5:
                return  DB::table ('account_types')->where('id','=', 5 )->value('name');
        }

        return 'Unknown';
    }

    public function user(){
      return  $this->belongsTo('App\User', 'owner_id');
    }

    public function movements(){
        return $this->hasMany('App\Movement', 'account_id', 'id');
    }
}


