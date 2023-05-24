<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'name',
        'address',
        'tel',
        'email',
        'birth',
        'unsub_date',
        'record_date'
    ];
    public function lendings(){
        return $this->hasMany(Lending::class ,'cust_id');
    }
}
