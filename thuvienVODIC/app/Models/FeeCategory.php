<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
    protected $fillable = [
        'name',
        'order',
    ];
    public function feeItems()
    {
        return $this->hasMany(FeeItem::class); 
    }
}
