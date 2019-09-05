<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retail_Offer extends Model
{
    use SoftDeletes;

    protected $table = 'retailer_offers';

    protected $guarded = ['id'];
}
