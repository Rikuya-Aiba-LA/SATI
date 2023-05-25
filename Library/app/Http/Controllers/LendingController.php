<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\Customer;


class LendingController extends Controller
{
    public function index(Request $request){
        
        if ($request->cust_id) {
            
            $lendings = Lending::where('cust_id',$request->cust_id)->orderBy('created_at','desc')->paginate(20);

        }else {
          $lendings = Lending::orderBy('id','desc')->paginate(20); 
        }
        
        return view('lendings/index',['lendings'=>$lendings]);
    }
    public function update(Request $request,Lending $lending, Customer $customer)
    {
        
        $this->validate($request, [
            'return_date'

        ]);
    
        $lending->update($request->all());
        return redirect(route('customers.show',$customer));
    }
}
