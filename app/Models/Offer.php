<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Offer
 * @package App\Models
 */
class Offer extends Model
{
    use SoftDeletes;

    public $table = 'offers';

    protected $guarded = ['id'];

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

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public static function all_by_retailer() {
        $query = DB::table('offers');
        $query->select(DB::raw("date, retailer_id, retailers.name as retailer, COUNT(offers.id) as nosOffers, DATE_FORMAT(offers.created_at,'%Y-%m-%d') as created_at, DATE_FORMAT(offers.updated_at,'%Y-%m-%d') as updated_at"));
        $query->join('retailers','retailers.id','=','offers.retailer_id');
        $query->whereNull('offers.deleted_at');
        $query->groupBy(DB::raw("retailers.name, date, retailer_id, DATE_FORMAT(offers.created_at,'%Y-%m-%d'), DATE_FORMAT(offers.updated_at,'%Y-%m-%d')"));
        $query->orderBy('date','DESC');
        $paginationEnabled = config('settings.enablePagination');
        if($paginationEnabled) {
            return $query->paginate(config('settings.paginateListSize'));
        } else {
            return $query->get();
        }
    }
    public static function get_batch_offers($retailer_id, $date) {
        $query = DB::table('offers');
        $query->select(DB::raw("offers.id, date, retailer_id, retailers.name as retailer, availability.name as available, departments.name as department, date_code, product, current_price, discount_offer, image_url, category, offer_url, offers.created_at, offers.updated_at"));
        $query->join('retailers','retailers.id','=','offers.retailer_id');
        $query->join('availability','availability.id','=','offers.availability_id');
        $query->join('departments','departments.id','=','offers.department_id');
        $query->where('offers.retailer_id','=',$retailer_id);
        $query->where('offers.date','=',$date);
        $query->whereNull('offers.deleted_at');
        $query->orderBy('date','DESC');
        $paginationEnabled = config('settings.enablePagination');
        if($paginationEnabled) {
            return $query->paginate(config('settings.paginateListSize'));
        } else {
            return $query->get();
        }
    }

    public static function get_todays_top_retailers($today){
        $query = DB::table('offers');
        $query->select(DB::raw('DISTINCT retailers.id, retailers.name, retailers.url, retailers.logo'));
        $query->join('retailers','retailers.id','=','offers.retailer_id');
        $query->whereNULL('retailers.deleted_at');
        $query->whereNULL('offers.deleted_at');
        $query->where('offers.created_at','like',$today.'%');
        $query->limit(10);
        return $query->get();
    }

    public static function get_todays_top_offers($today) {
        $query = DB::table('offers');
        $query->select(DB::raw('product, image_url, discount_offer, offer_url, current_price, retailers.name as retailer'));
        $query->join('retailers','retailers.id','=','offers.retailer_id');
        $query->whereNULL('offers.deleted_at');
        $query->where('offers.created_at','like',$today.'%');
        $query->orderBy('offers.discount_offer','DESC');
        $query->limit(10);
        return $query->get();
    }

    public static function get_todays_offers($retailer = null, $department = null, $availability_id = null, $price = null, $discount = null) {
        $last_update = Offer::get_last_udpated_date();
        $date = explode(" ", $last_update->created_at);
        $query = DB::table('offers');
        $query->select(DB::raw('CAST(CONVERT(SUBSTRING(product, 1, 50) USING utf8) AS BINARY) as product, image_url, discount_offer, offer_url, current_price, retailers.name as retailer'));
        $query->join('retailers','retailers.id','=','offers.retailer_id');
        if($retailer!="null")
            $query->where('retailer_id','=',$retailer);
        if($department!="null")
            $query->where('department_id','=',$department);
        if($availability_id!="null")
            $query->where('availability_id','=',$availability_id);
        if($price!=null)
            $query->orderBy('current_price',$price);
        if($discount!=null)
            $query->orderBy('discount_offer',$discount);
        $query->whereNULL('offers.deleted_at');
        $query->where('offers.created_at','like',$date[0].'%');
        return $query->paginate(24);
    }

    public static function get_offers_size($retailer = null, $department = null, $availability_id = null) {
        $last_update = Offer::get_last_udpated_date();
        $date = explode(" ", $last_update->created_at);
        $query = DB::table('offers');
        $query->select(DB::raw('product, image_url, discount_offer, offer_url, current_price'));
        if($retailer!="null")
            $query->where('retailer_id','=',$retailer);
        if($department!="null")
            $query->where('department_id','=',$department);
        if($availability_id!="null")
            $query->where('availability_id','=',$availability_id);
        $query->whereNULL('offers.deleted_at');
        $query->where('offers.created_at','like',$date[0].'%');
        //$query->where(DATE('created_at'),'=','CURDATE');
        return $query->count();
    }

    public static function get_last_udpated_date() {
        $query = DB::table('offers');
        $query->select(DB::raw('created_at'));
        $query->whereNULL('offers.deleted_at');
        //$query->where(DATE('created_at'),'=','CURDATE');
        $query->orderBy('offers.discount_offer','DESC');
        $query->limit(1);
        return $query->first();
    }
}
