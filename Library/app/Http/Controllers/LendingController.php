<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;

class LendingController extends Controller
{
    public function index(){
        $lendings = Lending::orderBy('created_at','desc')->paginate(20);
        return view('lendings/index',['lendings'=>$lendings]);
    }
}
