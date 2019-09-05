<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class General extends Model {
    public static function arrDropdown($table, $message) {
        $output[null] = 'Select '.$message;
        $tables = array('countries', 'availability','departments','retailers');
        if(!in_array($table, $tables)){
            $output[null] = 'No data found';
            return $output;
        }
        $query = \DB::table($table);
        $query->select('id','name');
        $result = $query->orderBy('name')->get();

        if(count($result)>0):
            foreach ($result as $item):
                $output[$item->id] = $item->name;
            endforeach;
        endif;
        return $output;
    }
}