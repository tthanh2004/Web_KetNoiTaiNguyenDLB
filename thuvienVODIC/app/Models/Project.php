<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'code_number', 
        'name', 
        'content', 
        'start_date', 
        'user_id', // Admin tạo
        'project_group_id', 
        'implementing_unit_id'
    ];

    // Liên kết đến Admin tạo
    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Liên kết đến Đơn vị
    public function implementing_unit() {
        return $this->belongsTo(ImplementingUnit::class, 'implementing_unit_id');
    }

    // Liên kết đến Tài liệu con
    public function documents() {
        return $this->hasMany(Document::class);
    }
}
