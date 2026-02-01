<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    // Khai báo các cột được phép lưu
    protected $fillable = [
        'code_number', 
        'name', 
        'content', 
        'start_date', 
        'status', 
        'progress', 
        'completed_at',
        'parent_id', 
        'project_group_id', 
        'implementing_unit_id', 
        'user_id'
    ];

    // Tự động ép kiểu dữ liệu ngày tháng
    protected $casts = [
        'start_date' => 'date',
        'completed_at' => 'date',
    ];

    // --- CÁC MỐI QUAN HỆ (RELATIONSHIPS) ---

    /**
     * 1. Liên kết với Nhóm dự án (project_groups)
     * Tên hàm phải trùng với tên gọi trong Controller: 'project_group'
     */
    public function project_group()
    {
        return $this->belongsTo(ProjectGroup::class, 'project_group_id');
    }

    /**
     * 2. Liên kết với Đơn vị thực hiện (implementing_units)
     * Tên hàm: 'implementing_unit'
     */
    public function implementing_unit()
    {
        return $this->belongsTo(ImplementingUnit::class, 'implementing_unit_id');
    }

    /**
     * 3. Liên kết với Người tạo (users)
     * Tên hàm: 'creator' (nhưng khóa ngoại là 'user_id')
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 4. Liên kết đệ quy (Dự án cha - con)
     */
    public function parent()
    {
        return $this->belongsTo(Project::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Project::class, 'parent_id');
    }

    public function documents()
    {
        // Giả sử bảng documents có cột project_id
        return $this->hasMany(Document::class);
    }
}