<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];
    public function implementing_units() {
    return $this->hasMany(ImplementingUnit::class);
}

    // Quan hệ: Bộ -> Đơn vị -> Dự án (Dùng để đếm dự án của Bộ)
    public function projects() {
        return $this->hasManyThrough(Project::class, ImplementingUnit::class);
    }
}
