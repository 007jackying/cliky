<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    protected $table = "temps";

    protected $fillable = [
        'availability_id',
        'date',
        'date_code',
        'retailer_id',
        'product',
        'current_price',
        'discount_offer',
        'image_url',
        'department_id',
        'category',
        'offer_url',
    ];
}
