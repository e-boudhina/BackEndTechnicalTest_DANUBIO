<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    use HasFactory;

    //Possible fillable fields (id removed)
    protected $fillable = [
        'type',
        'address',
        'size',
        'size_unit',
        'bedrooms',
        'price',
        'location',
    ];
    public $timestamps = false;
}
