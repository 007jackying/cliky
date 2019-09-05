<?php

namespace App\Http\Controllers;

use App\Models\Offer;


class MobileController extends Controller{
    public function index() {
        app('debugbar')->disable();
        $last_update = Offer::get_last_udpated_date();
        $date = explode(" ", $last_update->created_at);
        $retailers = Offer::get_todays_top_retailers($date[0]);
        $offers = Offer::get_todays_top_offers($date[0]);
        return view('pages.user.dashboard',compact('last_update','retailers','offers'));
    }

    public function offers($retailer = null, $department = null, $type = null, $price = null, $discount = null) {
        app('debugbar')->disable();
        $total_results = Offer::get_offers_size($retailer, $department, $type);
        return view('pages.user.offer',compact('total_results','retailer','department','type','price','discount'));
    }
}