<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'classify_id',
        'author',
        'publisher',
        'publish_date',
        'isbn',
        'trash_date'
    ];

    public function lendings(){
        return $this->hasMany(Lending::class);
    }
}
