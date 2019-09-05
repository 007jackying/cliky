<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Department;
use App\Models\Flag;
use App\Models\General;
use App\Models\Offer;
use App\Models\Retailer;
use App\Models\Users;
use Config;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use jeremykenedy\LaravelRoles\Models\Role;
use Symfony\Component\Process\Process;
use Rap2hpoutre\FastExcel\FastExcel;
use Validator;

class OfferManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $roles = Role::all();
        $offers = Offer::all_by_retailer();

        return View('offermanagement.show-offers',compact('offers','roles'));
    }

    public function create() {
        $roles = Role::all();
        $arr_available = General::arrDropdown('availability', 'Availability');
        $arr_department = General::arrDropdown('departments', 'Department');
        $arr_retailer = General::arrDropdown('retailers', 'Retailers');
        $data = [
            'roles'          => $roles,
            'arr_available'  => $arr_available,
            'arr_department' => $arr_department,
            'arr_retailer'   => $arr_retailer
        ];

        return view('offermanagement.create-offer')->with($data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'product'         => 'required|max:255',
                'availability_id' => '',
                'date'            => 'required',
                'date_code'       => '',
                'retailer_id'     => 'required',
                'current_price'   => 'required|numeric|between:0,9999.99',
                'discount_offer'  => 'required|numeric|between:0,99.99',
                'image_url'       => 'required',
                'deparment_id'    => '',
                'category'        => '',
                'offer_url'       => 'required'
            ],
            [
                'product.required'        => trans('offermanagement.validation.productRequired'),
                'date.required'           => trans('offermanagement.validation.dateRequired'),
                'retailer_id.required'    => trans('offermanagement.validation.retailerRequired'),
                'current_price.required'  => trans('offermanagement.validation.priceRequired'),
                'discount_offer.required' => trans('offermanagement.validation.discountRequired'),
                'image_url.required'      => trans('offermanagement.validation.imageRequired'),
                'offer_url.required'      => trans('offermanagement.validation.urlRequired')
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $offer = Offer::create([
           'availability_id' => $request->input('availability_id'),

           'date' => date('Y-m-d',strtotime($request->input('date'))),
           'date_code' => $request->input('date_code'),
           'retailer_id' => $request->input('retailer_id'),
           'product' => $request->input('product'),
           'current_price' => $request->input('current_price'),
           'discount_offer' => $request->input('discount_offer'),
           'image_url' => $request->input('image_url'),
           'department_id' => $request->input('department_id'),
           'category' => $request->input('category'),
           'offer_url' => $request->input('offer_url'),

        ]);

        $offer->save();

        return redirect('offers')->with('success',trans('offermanagement.createSuccess'));
    }

    public function details($retailer_id, $date) {
        $roles = Role::all();
        $retailer = Retailer::find($retailer_id);
        $offers = Offer::get_batch_offers($retailer_id, $date);

        return View('offermanagement.show-details',compact('offers','roles','retailer','date'));
    }

    public function show($id) {

    }

    public function edit($id) {
        $roles = Role::all();
        $offer = Offer::findOrFail($id);
        $arr_available = General::arrDropdown('availability', 'Availability');
        $arr_department = General::arrDropdown('departments', 'Department');
        $arr_retailer = General::arrDropdown('retailers', 'Retailers');
        $data = [
            'roles'          => $roles,
            'arr_available'  => $arr_available,
            'arr_department' => $arr_department,
            'arr_retailer'   => $arr_retailer,
            'offer'          => $offer,
        ];

        return view('offermanagement.edit-offer')->with($data);
    }

    public function update(Request $request, $id) {
        $offer = Offer::find($id);
        $validator = Validator::make($request->all(),
            [
                'product'         => 'required|max:255',
                'availability_id' => '',
                'date'            => 'required',
                'date_code'       => '',
                'retailer_id'     => 'required',
                'current_price'   => 'required|numeric|between:0,9999.99',
                'discount_offer'  => 'required',
                'image_url'       => 'required',
                'deparment_id'    => '',
                'category'        => '',
                'offer_url'       => 'required'
            ],
            [
                'product.required'        => trans('offermanagement.validation.productRequired'),
                'product.required'        => trans('offermanagement.validation.productRequired'),
                'date.required'           => trans('offermanagement.validation.dateRequired'),
                'retailer_id.required'    => trans('offermanagement.validation.retailerRequired'),
                'current_price.required'  => trans('offermanagement.validation.priceRequired'),
                'discount_offer.required' => trans('offermanagement.validation.discountRequired'),
                'image_url.required'      => trans('offermanagement.validation.imageRequired'),
                'offer_url.required'      => trans('offermanagement.validation.urlRequired')
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $offer->availability_id = $request->input('availability_id');
        $offer->date = date('Y-m-d',strtotime($request->input('date')));
        $offer->date_code = $request->input('date_code');
        $offer->retailer_id = $request->input('retailer_id');
        $offer->product = $request->input('product');
        $offer->current_price = $request->input('current_price');
        $offer->discount_offer= $request->input('discount_offer');
        $offer->image_url = $request->input('image_url');
        $offer->department_id = $request->input('department_id');
        $offer->category = $request->input('category');
        $offer->offer_url = $request->input('offer_url');
        $offer->save();

        return back()->with('success', trans('offermanagement.updateSuccess'));
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect('offers')->with('success',trans('offermanagement.deleteSuccess'));
    }

    public function import() {
        $roles = Role::all();
        return view('offermanagement.import-offers');
    }

    public function processImport(Request $request)
    {
        $csvFile = $request->file('offersFile');

        $validator = Validator::make($request->all(), [
            'offersFile' => 'required'
        ]);
        /*$validator->after(function ($validator) use ($csvFile) {
            if ($csvFile->guessClientExtension() !== 'csv')
                $validator->errors()->add('field', 'FIle type is not valid - only CSV file is allowed');
        });*/

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try {
            $fname = md5(rand()) . '.csv';
            $full_path = Config::get('filesystems.disks.local.root');
            $csvFile->move($full_path, $fname);
            $flag = Flag::firstorNew(['file_name' => $fname]);
            $flag->imported = 0;
            $flag->save();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
        ini_set('max_execution_time', 180);
        $sleeper = 100;

        ini_set('memory_limit', '768M');

        $file = Flag::where('imported','=','0')->orderBy('created_at','DESC')->first();

        $file_path = Config::get('filesystems.disks.local.root').'/'.$file->file_name;

        $retailers = Retailer::getArray();
        $departments = Department::getArray();
        $availability = Availability::getArray();

        try {
            $temporary = (new FastExcel)->configureCsv(',', '#')->import($file_path, function ($line) use ($availability, $retailers, $departments, $file) {
                return Offer::create([
                    'availability_id' => array_search($line['update_type'], $availability),
                    'date'            => date('Y-m-d', strtotime($line['update_date'])),
                    'date_code'       => htmlspecialchars($line['date_code']),
                    'retailer_id'     => array_search($line['retailer'], $retailers),
                    'product'         => htmlspecialchars($line['product']),
                    'current_price'   => htmlspecialchars($line['now']),
                    'discount_offer'  => htmlspecialchars($line['off']),
                    'image_url'       => htmlspecialchars($line['image_url']),
                    'department_id'   => array_search($line['dept'], $departments),
                    'category'        => htmlspecialchars($line['category']),
                    'offer_url'       => htmlspecialchars($line['url']),
                ]);
            });

        } catch (IOException $e) {
        } catch (UnsupportedTypeException $e) {
        } catch (ReaderNotOpenedException $e) {
        }
        return redirect('offers')->with('success', 'Hold on tight. Your file is being processed');
    }

    public function status(Request $request) {
        $flag = DB::table('flags')->orderBy('created_at','desc')->first();

        if(empty($flag)) {
            return response()->json(['msg'=>'done']);
        }

        if($flag->imported === 1) {
            return response()->json(['msg'=>'done']);
        } else {
            $status = $flag->rows_imported . ' excel rows have been imported out of a total of ' . $flag->total_rows;
            return response()->json(['msg' => $status]);
        }
    }

    public function upload_old(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'offersFile'         => 'required|mimes:csv',
            ],
            [
                'offersFile.required'        => trans('offermanagement.validation.offersFileRequired'),
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = date('YmdHis');
        $fileName = $name.'.'.$request->file('offersFile')->getClientOriginalExtension();

        $request->file('offersFile')->move(base_path().'/public/temp/',$fileName);

        $file = public_path('temp/'.$fileName);
        $offer_lists = $this->csvToArray($file);
        echo "<pre/>";
        print_r($offer_lists);
        die();

        Retailer::store(array_unique(array_column($offer_lists,'Retailer')));
        Department::store(array_unique(array_column($offer_lists, 'Dept')));
        Availability::store(array_unique(array_column($offer_lists, 'Update Type')));

        $retailers = Retailer::getArray();
        $deparments = Department::getArray();
        $availability = Availability::getArray();

        $listIgnored = Array();

        foreach ($offer_lists as $key => $offer) {
            if($offer['Product'] != null && $offer['Update Date']!= null && $offer['Retailer'] != null && $offer['Now $'] != null && $offer['% Off'] != null && $offer['Image URL']!=null && $offer['URL']!=null) {
                $offer = Offer::create([
                    'availability_id' => array_search($offer['Update Type'], $availability),
                    'date'            => date('Y-m-d', strtotime($offer['Update Date'])),
                    'date_code'       => $offer['Date Code'],
                    'retailer_id'     => array_search($offer['Retailer'], $retailers),
                    'product'         => $offer['Product'],
                    'current_price'   => $offer['Now $'],
                    'discount_offer'  => $offer['% Off'],
                    'imag/*e_url'       => $offer['Image URL'],
                    'department_id'   => array_search($offer['Dept'], $deparments),
                    'category'        => $offer['Category'],
                    'offer_url'       => $offer['URL'],

                ]);

                $offer->save();
            } else {
                array_push($listIgnored, $key+1);
            }
        }

        return redirect('offers')->with('success',trans('offermanagement.importSuccess')(count($listIgnored)>0)?'With following rows ignored'.implode($listIgnored):'');
    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }
}
