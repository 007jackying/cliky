<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Retailer extends Model
{
    use SoftDeletes;

    protected $table = 'retailers';

    protected $guarded = ['id'];

    public static function get_list() {
        $query = DB::table('retailers');
        $query->select(DB::raw("id, name, url, logo"));
        $query->whereNull('deleted_at');
        $query->orderBy('name');
        return $query->get();
    }

    public static function getArray() {
        $result = DB::table('retailers')->whereNull('deleted_at')->select('id','name')->get();

        if( count($result) > 0 ) {
            foreach ($result as $key => $item) {
                $output[$item->id] = $item->name ;
            }

        }
        return $output;
    }

    public static function checkDuplicate($retailer) {
        $query = DB::table('retailers')->where('name',$retailer)->whereNull('deleted_at')->get();

        return (count($query)>0?true:false);
    }

    public static function store($retailers) {
        foreach($retailers as $retailer) {
            $doesExist = Self::checkDuplicate($retailer);
            if(!$doesExist) {
                $retailer = Retailer::create([
                   'name' => $retailer
                ]);

            }
        }
    }
}
