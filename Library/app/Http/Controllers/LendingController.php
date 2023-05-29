<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;

use App\Models\Book;
use App\Models\Customer;


class LendingController extends Controller
{
    public function index(Request $request){
        
        if ($request->cust_id) {
            
            $lendings = Lending::where('cust_id',$request->cust_id)->orderBy('created_at','desc')->paginate(20);

        } elseif($request->title){
            $lendings = Lending::whereHas('book', function($query) use ($request){
                $query->where('title', 'LIKE', "%$request->title%");
            })->orderBy('created_at', 'desc')->paginate(20);
        } else {
          $lendings = Lending::orderBy('id','desc')->paginate(20); 
        }
        
        return view('lendings/index',['lendings'=>$lendings]);
    }


    //確認画面に値を持って遷移するメソッド
    public function check(Request $request, Customer $customer){
        $book = Book::find($request->book_id);
        return view('lendings/check', ['book'=>$book, 'customer'=>$customer]);
    }

    //確認画面から貸出台帳に登録するメソッド
    public function store(Request $request){
        $lending = new Lending(
            $request->all()
        );
        $lending->save();
        return redirect(route('customers.show', $lending->cust_id));
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
