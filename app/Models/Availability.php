<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Availability extends Model
{
    use SoftDeletes;
    protected $table = 'availability';

    protected $guarded = [
        'id',
    ];

    public static function getArray() {
        $result = DB::table('availability')->whereNull('deleted_at')->select('id','name')->get();
        if( count($result) > 0 ) {
            foreach ($result as $key => $item) {
                $output[$item->id] = $item->name ;
            }

        }
        return $output;
    }

    public static function checkDuplicate($available) {
        $query = DB::table('availability')->where('name',$available)->get();

        return (count($query)>0?true:false);
    }

    public static function store($availables) {
        foreach($availables as $available) {
            $doesExist = Self::checkDuplicate($available);
            if(!$doesExist) {
                $retailer = Availability::create([
                    'name' => $available
                ]);

            }
        }
    }
}
