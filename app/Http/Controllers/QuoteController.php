<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

use Validator;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class QuoteController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request){


      if($request->ajax()){

				$client = new \GuzzleHttp\Client();
				$res = $client->get('https://zenquotes.io/api/quotes/f2fa704d974dbaf641cacd41fc4c505c9d4c90a0?custom=true');
				
				if($res->getStatusCode() == 200){
					
					$quotes =  json_decode($res->getBody(), true);
				}else{
					$quotes = [];
				}

        return Datatables::of($quotes)
          ->addIndexColumn()
          ->addColumn('quotes', function ($data) {

            if(!empty($data['h'])){
              return $data['h'];
            }else{
              return "N/A";
            }
          })
          ->rawColumns(['quotes'])
          ->make(true);
      }
      
      return view('quote.index',[

      ]);
    }
}
