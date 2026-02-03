<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'description', 'file_url', 'thumbnail'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return 'https://placehold.co/600x400?text=No+Image';
        }

        if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
            return $this->thumbnail;
        }

        $path = $this->thumbnail;
        
        // Fix đường dẫn cũ
        if (strpos($path, 'public/') === 0) {
            $path = str_replace('public/', 'storage/', $path);
        }
        
        // Thêm prefix storage nếu chưa có
        if (strpos($path, 'storage/') === false) {
            $path = 'storage/' . $path;
        }

        // Mã hóa khoảng trắng để tránh lỗi 404
        return str_replace(' ', '%20', asset($path));
    }
}