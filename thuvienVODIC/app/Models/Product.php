<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'description', 'file_path', 'file_extension', 'thumbnail'];

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
        if (strpos($path, 'public/') === 0) {
            $path = str_replace('public/', 'storage/', $path);
        }

        return asset($path);
    }

    // Link tải file
    public function getFileUrlAttribute() {
        if (!$this->file_path) return null;
        return asset(str_replace('public/', 'storage/', $this->file_path));
    }
}