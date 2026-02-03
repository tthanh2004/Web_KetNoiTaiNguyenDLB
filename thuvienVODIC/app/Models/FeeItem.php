<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FeeCategory;

class FeeItem extends Model
{
    protected $fillable = [
        'name',
        'unit',
        'price',
        'fee_category_id',
    ];

    public function feeCategory()
    {
        return $this->belongsTo(FeeCategory::class);
    }
}
