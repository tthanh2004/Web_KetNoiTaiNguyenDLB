<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImplementingUnit extends Model
{
    protected $fillable = [
        'name',
        'ministry_id', // Khóa ngoại
    ];
    public function ministry() {
        return $this->belongsTo(Ministry::class);
    }
}
