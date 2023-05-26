<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->email) {
            
            $customers = Customer::where('email',$request->email)->orderBy('id','desc')->paginate(20);

        }elseif($request->unsub_date) {
          $customers = Customer::whereNotNull('unsub_date')->orderBy('id','desc')->paginate(20); 

        }else{
            $customers = Customer::whereNull('unsub_date')->orderBy('id','desc')->paginate(20); 
        }
        return view('customers.index',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $customer = new Customer;
        return view('customers/create', ['customer' => $customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:50',
            'address'=>'required|max:200',
            'tel'=>'required|max:20|numeric',
            'email'=>'required|max:50|unique:customers,email|email:filter',
            'birth'=>'required',
            'record_date'=>'required'
        ]);
        $customer = new Customer(
           $request->all()
        );
       $customer->save();
        return redirect(route('customers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request,Customer $customer)
    {
        $today = date('Y-m-d');
        $count = 0;
        $lend_num = $customer->lendings->whereNull('return_date')->count();
        foreach($customer->lendings as $data){
            if(strtotime($today) > strtotime($data->expectied_date) && is_null($data->return_date)){
                $count++;
            }
        }
        return view('customers/show', ['customer'=>$customer, 'count'=>$count, 'lend_num'=>$lend_num]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Customer $customer)
    {
        return view('customers/edit',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required|max:50',
            'address' => 'required|max:200',
            'tel' => 'required|regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/',
            'email'=>'required|max:50|email:filter',
            'birth' => 'required'

        ]);
    
        $customer->update($request->all());
        return redirect(route('customers.show',$customer));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function unsub(Request $request,Customer $customer)
    {
        $this->validate($request, [
            'unsub_date'

        ]);
    
        $customer->update($request->all());
        return redirect(route('customers.show',$customer));
    }
}
