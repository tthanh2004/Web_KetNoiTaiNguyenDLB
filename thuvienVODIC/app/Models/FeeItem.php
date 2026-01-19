<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeItem extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'price',
        'fee_category_id', // Khóa ngoại
    ];
}
