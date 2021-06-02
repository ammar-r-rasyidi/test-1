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


namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Validator;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

use App\Models\Companies;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){

      if($request->ajax()){

        $companies = Companies::select();

        return Datatables::of($companies)
          ->addIndexColumn()
          ->editColumn('logo', function ($data) {

            if(!empty($data->logo)){
              return "<div class='text-center'><img style='max-height: 80px' class='img-fluid' src='".asset('storage/'.$data->logo)."'></div>";
            }else{
              return "N/A";
            }
          })
          ->editColumn('website', function ($data) {

            if(!empty($data->website)){
              return "<a target='_blank' rel='noopener noreferrer' href='http://www.".$data->website."'>".$data->website."</a>";
            }else{
              return "N/A";
            }
          })
          ->rawColumns(['logo', 'website'])
          ->make(true);
      }
      
      return view('companies.index',[

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
          'name'          => 'required|max:255|unique:companies',
        ]);

        $input = $request->all();

        if($validator->passes()){

          $current_timestamp = Carbon::now()->timestamp;

          if($request->hasFile('logo')) {

            $file      = $request->file('logo');
            $name      = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = ".".$file->getClientOriginalExtension();

            $stored_file = $file->storeAs('files_upload/logo', $name."_".$current_timestamp.$extension, "public");

            $input['logo'] = $stored_file;
          }

          unset($input['MAX_FILE_SIZE']);
          
          $companies = Companies::create($input);

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

      $companies = Companies::findOrFail($id);

      if($request->ajax()){

        return response()->json([
            'companies' => $companies,
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
          'name'          => 'required|max:255|unique:companies,name,'.$id,
        ]);

        $input = $request->all();

        if($validator->passes()){
          
          $current_timestamp = Carbon::now()->timestamp;

          $companies = Companies::findOrFail($id);

          if($request->hasFile('logo')) {

            $file      = $request->file('logo');
            $name      = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = ".".$file->getClientOriginalExtension();

            $stored_file = $file->storeAs('files_upload/logo', $name."_".$current_timestamp.$extension, "public");

            $input['logo'] = $stored_file;
          }

          unset($input['MAX_FILE_SIZE']);

          $companies->update($input);

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

        $companies = Companies::findorFail($id);

        if($companies){

          if(!empty($companies->logo)){
            if (file_exists(public_path('storage')."/".$companies->logo)) {
                unlink(public_path('storage')."/".$companies->logo);
            }
          }

          Companies::findorFail($id)->delete();

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
}
