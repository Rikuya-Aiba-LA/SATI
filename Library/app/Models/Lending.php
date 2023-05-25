<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;


    protected $fillable = [
        'cust_id',
        'book_id',
        'lend_date',
        'expectied_date',
        'return_date'
    ];


    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class ,'cust_id');
    }
}
