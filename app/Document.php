<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{


    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','original_name', 'description','created_at'
    ];


    public function document(){
        return $this->hasOne('App\Movement', 'document_id', 'id');
    }
}


