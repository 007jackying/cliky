<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Mockery\Exception;
use Validator;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use DB;

class DepartmentController extends Controller
{
    public function __construct()
    { $this->middleware('auth'); }

    public function index() {
        $roles = Role::all();
        $departments = DB::table('departments')->whereNULL('deleted_at')->orderBy('id', 'DESC')->paginate(10);
        return View('departments.list',compact('departments'));
    }

    public function create() {
        return View('departments.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),
                [
                    'name' => 'required|unique:departments'
                ],
                [
                    'name.required' => trans('departmentmanagement.validation.nameRequired')
                ]
            );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $department = Department::create([
               'name' => $request->input('name')
            ]);
            $department->save();
            return redirect('departments')->with('success',trans('departmentmanagement.createSuccess'));
        } catch(Exception $e) { return back()->withErrors($e->getMessage());}
    }

    public function details($id) {
        return View('departments.show',compact(''));
    }

    public function edit($id) {
        $roles = Role::all();
        $department = Department::findOrFail($id);
        return View('departments.edit',compact('roles','department'));
    }

    public function update(Request $request, $id) {
        $department = Department::find($id);
        $validator = Validator::make($request->all(),
            [
                'name' => 'required'
            ],
            [
                'name.required' => trans('departmentmanagement.validation.nameRequired')
            ]
        );
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $department->name = $request->input('name');
        $department->save();

        return redirect('departments')->with('success',trans('departmentmanagement.updateSuccess'));
    }

    public function destroy($id) {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect('departments')->with('success',trans('departmentmanagement.deleteSuccess'));
    }
}
