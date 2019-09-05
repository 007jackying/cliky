<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription_Type extends Model
{
    use SoftDeletes;

    protected $table = 'subscription_types';

    protected $guarded = ['id'];
}
