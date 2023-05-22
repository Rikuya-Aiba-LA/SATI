<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    public function books(){
        return $this->hasmany(Book::class);
    }

    public function customers(){
        return $this->hasmany(Customer::class);
    }
}
