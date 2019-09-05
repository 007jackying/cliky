<?php

namespace App\Http\Controllers;

use App\Models\Retailer;
use Mockery\Exception;
use Validator;
use Illuminate\Http\Request;
use App\Models\Users;
use Config;
use App\Models\Flag;
use DB;
use jeremykenedy\LaravelRoles\Models\Role;

class RetailerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $roles = Role::all();
        $retailers = DB::table('retailers')->whereNULL('deleted_at')->orderBy('id', 'DESC')->paginate(10);
        return View('retailers.list-retailers',compact('retailers'));
    }

    public function create() {
        return View('retailers.create-retailer',compact(''));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),
                     [
                        'name' => 'required|max:50',
                        'url' => 'required',
                        'logo' => 'required'
                     ],
                    [
                        'name.required' => trans('retailermanagement.validation.nameRequired'),
                        'url.required' => trans('retailermanagement.validation.urlRequired'),
                        'logo.required' => trans('retailermanagement.validation.imageRequired')
                    ]
        );
        if(Retailer::checkDuplicate($request->input('name')) == true)
            return back()->withErrors("Retailer with that name already Exist")->withInput();
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $logofile = $request->file('logo');
            $logo = md5(rand()).'.png';
            $full_path = Config::get('filesystems.disks.public.logo_path');
            $file_path = '/images/branding/'.$logo;
            $logofile->move($full_path, $logo);
            $flag = Flag::firstorNew(['file_name'=>$logo]);
            $flag->imported = 0;
            $flag->save();

            $retailer = Retailer::create([
               'name' => $request->input('name'),
                'url' => $request->input('url'),
                'logo' => $file_path,
            ]);
            $retailer->save();
            return redirect('retailers')->with('success',trans('retailermanagement.createSuccess'));
        } catch (Exception $e) { return back()->withErrors($e->getMessage());}
    }

    public function details($id) {
        return View('retailers.show-detail',compact(''));
    }

    public function edit($id) {
        $roles = Role::all();
        $retailer = Retailer::findOrFail($id);
        return View('retailers.edit-retailer',compact('roles','retailer'));
    }

    public function update(Request $request, $id) {
        $retailer = Retailer::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:50',
                'url' => 'required'
            ],
            [
                'name.required' => trans('retailermanagement.validation.nameRequired'),
                'url.required' => trans('retailermanagement.validation.urlRequired')
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $retailer->name = $request->input('name');
        $retailer->url = $request->input('url');
        $retailer->save();

        return back()->with('success', trans('retailermanagement.updateSuccess'));
    }

    public function destroy($id) {
        $retailer = Retailer::findOrFail($id);
        $retailer->delete();
        return redirect('retailers')->with('success',trans('retailermanagement.deleteSuccess'));
    }

}
