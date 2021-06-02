<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use DB;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search(Request $request){

      $module_restriction = [
        'user'
      ];

      if(in_array(strtolower($request->module), $module_restriction)){
        abort('404');
      }

      $module = "\Modules\\".$request->module."\\Models\\".$request->model;
      
      if (!is_subclass_of($module, 'Illuminate\Database\Eloquent\Model')) {
        abort('404');        
      }

      if(!$request->has('fields')){
        abort('404');
      }

      $fields = $request->fields;
      $param = $fields[1];
      $fields[0] = $fields[0].' AS id';

      if(!empty($fields[2])){
        $fields[1] = DB::raw('CONCAT('.$fields[1].', " : ", '.$fields[2].') AS text');
      }else{
        $fields[1] = $fields[1].' AS text';
      }

      if($request->has('extra_id')){
        $fields[] = $request->extra_id;
      }

      $model = $module::select($fields);

      if($request->has('jenjang') && $request->has('jenjang')){
        $model->where('jenjang', $request->jenjang);
      }

      if($request->has('reference') && $request->has('reference_id')){
        $model->where($request->reference, $request->reference_id);
      }

      if($request->has('where_not') && $request->has('where_not_id')){
        $model->where($request->where_not, '!=', $request->where_not_id);
      }

      if($request->has('q')){
        $search = $request->q;
        $model->where($param, 'LIKE', "%$search%");
      }

      if($request->has('extra')){
        $model->with($request->extra);
      }

      if($request->has('group_by')){
        $model->groupBy($request->group_by);
      }

      $model = $model->limit(100)->get();
      if($request->has('hidden_fields')){
        $hidden_fields = $request->hidden_fields;
        $model->makeHidden($hidden_fields);
      }

      return $model;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function search_dpa(Request $request){

      $module_restriction = [
        'user'
      ];

      if(in_array(strtolower($request->module), $module_restriction)){
        abort('404');
      }

      $module = "\Modules\\".$request->module."\\Models\\".$request->model;
      
      if (!is_subclass_of($module, 'Illuminate\Database\Eloquent\Model')) {
        abort('404');        
      }

      if(!$request->has('fields')){
        abort('404');
      }

      $fields = $request->fields;
      $param = $fields[1];
      $fields[0] = $fields[0].' AS id';

      if(!empty($fields[2])){
        $fields[1] = DB::raw('CONCAT('.$fields[1].', " : ", '.$fields[2].') AS text');
      }else{
        $fields[1] = $fields[1].' AS text';
      }

      if($request->has('extra_id')){
        $fields[] = $request->extra_id;
      }

      $model = $module::select($fields);

      if($request->has('reference') && $request->has('reference_id')){
        $model->where($request->reference, $request->reference_id);
      }

      if($request->has('where_not') && $request->has('where_not_id')){
        $model->where($request->where_not, '!=', $request->where_not_id);
      }
      if($request->has('where_multiple') && $request->has('where_not_id')){
        $model->where($request->where_multiple);
      }

      if($request->has('q')){
        $search = $request->q;
        $model->where($param, 'LIKE', "%$search%");
      }

      if($request->has('extra')){
        $model->with($request->extra);
      }

      if($request->has('group_by')){
        $model->groupBy($request->group_by);
      }

      $model = $model->limit(100)->get();
      if($request->has('hidden_fields')){
        $hidden_fields = $request->hidden_fields;
        $model->makeHidden($hidden_fields);
      }

      return $model;
    }
}
