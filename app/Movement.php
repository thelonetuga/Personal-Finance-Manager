<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Movement extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id,movement_category_id','date', 'value','start_balance', 'type' , 'end_balance', 'description','document_id','created_at'
    ];

    public function typeToStr()
    {
        switch ($this->movement_category_id) {
            case 0:
                return 'Unknown';
            case 1:
                return DB::table ('movement_categories')->where('id','=', 1 )->value('name');
            case 2:
                return  DB::table ('movement_categories')->where('id','=', 2 )->value('name');
            case 3:
                return  DB::table ('movement_categories')->where('id','=', 3 )->value('name');
            case 4:
                return  DB::table ('movement_categories')->where('id','=', 4 )->value('name');
            case 5:
                return  DB::table ('movement_categories')->where('id','=', 5 )->value('name');
            case 6:
                return DB::table ('movement_categories')->where('id','=', 6 )->value('name');
            case 7:
                return  DB::table ('movement_categories')->where('id','=', 7 )->value('name');
            case 8:
                return  DB::table ('movement_categories')->where('id','=', 8 )->value('name');
            case 9:
                return  DB::table ('movement_categories')->where('id','=', 9 )->value('name');
            case 10:
                return  DB::table ('movement_categories')->where('id','=', 10 )->value('name');
            case 11:
                return DB::table ('movement_categories')->where('id','=', 11 )->value('name');
            case 12:
                return  DB::table ('movement_categories')->where('id','=', 12 )->value('name');
            case 13:
                return  DB::table ('movement_categories')->where('id','=', 13 )->value('name');
            case 14:
                return  DB::table ('movement_categories')->where('id','=', 14 )->value('name');
            case 15:
                return  DB::table ('movement_categories')->where('id','=', 15 )->value('name');
            case 16:
                return DB::table ('movement_categories')->where('id','=', 16 )->value('name');
            case 17:
                return  DB::table ('movement_categories')->where('id','=', 17 )->value('name');
            case 18:
                return  DB::table ('movement_categories')->where('id','=', 18 )->value('name');
        }

        return 'Unknown';
    }

    function is_selected($current, $expected, $output = 'selected')
    {
        if ($current === $expected) {
            return $output;
        }
    }
}
