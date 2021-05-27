<?php
/*!
* Copyright 2020
* Authors : ammar rizal rasyidi
* Authors Email : (ammar.r.rasyidi@gmail.com)
* Licensed under Personal Use License

* The content owner grants the buyer a non-exclusive, perpetual, personal use
* license to view, download, display, and copy the content, subject to the
* following restrictions:

* The content is licensed for personal use only, not commercial use. The
* content may not be used in any way whatsoever in which you charge money,
* collect fees, or receive any form of remuneration. The content may not be
* resold, relicensed, sub-licensed, rented, leased, or used in advertising.

* Title and ownership, and all rights now and in the future, of and for the
* content remain exclusively with the content owner.

* There are no warranties, express or implied. The content is provided 'as
* is.'

* Neither the content owner, payment processing service, nor hosting service
* will be liable for any third party claims or incidental, consequential, or
* other damages arising out of this license or the buyer's use of the content. */


namespace Modules\Employees\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Validator;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use Modules\Employees\Models\Employees;
use Modules\Companies\Models\Companies;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){

      if($request->ajax()){

        $employees = Employees::select('*')->with(['company']);

        return Datatables::of($employees)
          ->addIndexColumn()
          ->addColumn('full_name', function ($data) {

            if(!empty($data->full_name)){
              return $data->full_name;
            }else{
              return "N/A";
            }
          })
          ->addColumn('company_modal', function ($data) {
              return "<a class='btn btn-default btn-block modal-company' data-toggle='modal' data-target='#modal-company' data-id='".$data->company->id."'>".$data->company->name."</button>";
          })
          ->rawColumns(['company_modal'])
          ->make(true);
      }
      
      return view('employees::index',[

      ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request){

      if($request->ajax()){

        $validator = Validator::make($request->all(), [
          'first_name'     => 'required|max:255',
          'last_name'      => 'required|max:255'
        ]);

        $input = $request->all();

        if($validator->passes()){

          $employees = Employees::create($input);

          return response()->json([
            'code'            => 200,
            'status'          => 'success',
            'message'         => 'Data Berhasil Ditambahkan'
          ]);
        }

        return response()->json([
          'code'            => 422,
          'status'          => 'errors',
          'message'         => 'Data Gagal Ditambahkan',
          'errors_message'  => $validator->errors()
        ], 422);

      }

      return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request,  $id){

      $employees = Employees::with('company')->findOrFail($id);

      if($request->ajax()){

        return response()->json([
            'employees' => $employees,
        ]);
      }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id){

      if($request->ajax()){

        $validator = Validator::make($request->all(), [
          'first_name'     => 'required|max:255|unique:employees,'.$id,
          'last_name'      => 'required|max:255'
        ]);

        $input = $request->all();

        if($validator->passes()){
          
          $employees = Employees::findOrFail($id);

          $employees->update($input);

          return response()->json([
            'code'            => 200,
            'status'          => 'success',
            'message'         => 'Data Berhasil Diperbarui'
          ]);
        }

        return response()->json([
          'code'            => 422,
          'status'          => 'errors',
          'message'         => 'Data Gagal Diperbarui',
          'errors_message'  => $validator->errors()
        ], 422);

      }

      return abort('404');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id){

      if($request->ajax()){

        $employees = Employees::findorFail($id);

        if($employees){

          if(!empty($employees->logo)){
            if (file_exists(public_path('storage')."/".$employees->logo)) {
                unlink(public_path('storage')."/".$employees->logo);
            }
          }

          Employees::findorFail($id)->delete();

          return response()->json([
            'code'    => 200,
            'status'  => 'success',
            'message' => 'Data Berhasil Dihapus'
          ]);

        }

        return response()->json([
          'code'            => 422,
          'status'          => 'errors',
          'message'         => 'Data Gagal Dihapus',
          'errors_message'  => $validator->errors()
        ], 422);

      }

      return abort('404');

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function data_company(Request $request,  $id){

      $company = Companies::findOrFail($id);

      if($request->ajax()){

        return response()->json([
            'company' => $company,
        ]);
      }
    }

}
