<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

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
}


