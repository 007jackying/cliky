<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Retailer;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use App\Models\Offer;
use App\Models\Department;
use App\Models\Availability;


class APIController extends Controller {

    public function me() {
        $user = Auth::user();
        $user_detail = User::get_User_byId($user['id']);
        return \Response::json($user_detail);
    }

    public function register(Request $request) {
        $input = $request->json()->all();

        $regController = new RegisterController();
        $isUser = $regController->accessCreate($input);

        if($isUser):
            return 'success';
        else:
            return 'fail';
        endif;
    }

    public function retailers() {
        $retailers = Retailer::all();
        return \Response::json(['retailers'=>$retailers]);
    }

    public function departments() {
        $departments = Department::all();
        return \Response::json(['departments'=>$departments]);
    }

    public function types() {
        $types = Availability::all();
        return \Response::json(['types'=>$types]);
    }

    public function topRetailers() {
        $retailers = Offer::get_top_retailers();
        return \Response::json(['retailers'=>$retailers]);
    }

    public function topOffers() {
        $offers = Offer::get_top_offers();
        return \Response::json(['offers'=>$offers]);
    }

    public function offers($retailer = null, $department = null, $type = null, $price = null, $discount = null) {
        $offers = Offer::get_todays_offers($retailer, $department, $type, $price, $discount);
        return \Response::json(['offers'=>$offers]);
    }

    public function getOfferCount() {
        return Offer::get_offers_size();
        //return \Response::json(['count'=>Offer::get_offers_size()]);
    }
}