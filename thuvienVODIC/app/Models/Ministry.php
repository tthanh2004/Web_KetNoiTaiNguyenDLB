<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $fillable = ['name', 'code'];

    public function implementing_units() {
        return $this->hasMany(ImplementingUnit::class);
    }

    // Quan hệ 1: Dự án do Bộ trực tiếp chủ trì (Dự án cha)
    public function direct_projects() {
        return $this->hasMany(Project::class, 'ministry_id');
    }

    // Quan hệ 2: Dự án do Đơn vị con thực hiện
    public function indirect_projects() {
        return $this->hasManyThrough(Project::class, ImplementingUnit::class);
    }
}