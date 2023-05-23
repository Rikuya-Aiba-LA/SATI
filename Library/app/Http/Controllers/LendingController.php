<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;

class LendingController extends Controller
{
    public function index(Request $request){
        
        if ($request->cust_id) {
            
            $lendings = Lending::where('cust_id',$request->cust_id)->orderBy('created_at','desc')->paginate(20);

        }else {
          $lendings = Lending::orderBy('created_at','desc')->paginate(20); 
        }
        
        return view('lendings/index',['lendings'=>$lendings]);
    }
}
