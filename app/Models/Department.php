<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use SoftDeletes;

    protected $table = 'departments';

    protected $guarded = [
        'id',
    ];

    public static function getArray() {
        $result = DB::table('departments')->whereNull('deleted_at')->select('id','name')->get();
        if( count($result) > 0 ) {
            foreach ($result as $key => $item) {
                $output[$item->id] = $item->name ;
            }

        }
        return $output;
    }

    public static function checkDuplicate($department) {
        $query = DB::table('departments')->where('name',$department)->get();

        return (count($query)>0?true:false);
    }

    public static function store($departments) {
        foreach($departments as $department) {
            $doesExist = Self::checkDuplicate($department);
            if(!$doesExist) {
                $retailer = Department::create([
                    'name' => $department
                ]);

            }
        }
    }

}
