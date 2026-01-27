<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Các cột được phép lưu dữ liệu
    protected $fillable = [
        'name', 
        'description', 
        'file_url', 
        'project_id' // Khóa ngoại liên kết bảng Projects
    ];

    // Mối quan hệ: Sản phẩm này thuộc dự án nào?
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}