<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ministry; 
use App\Models\ImplementingUnit;
use App\Models\ProjectGroup;
use App\Models\User;
use App\Models\Field;
use App\Models\Document;

class Project extends Model
{
    protected $fillable = [
        'name', 
        'code_number', 
        'library_code', 
        'thumbnail', 
        'content', 
        'note', 
        'start_year', 
        'end_year', 
        'handover_time',
        'scale', 
        'budget', 
        'price', 
        'cabinet_location', 
        'data_entry_person',
        'parent_id', 
        'project_group_id', 
        'implementing_unit_id', 
        'ministry_id',
        'field_id',
        'status'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }
    // Quan hệ: Dự án con (Dự án thành phần)
    public function children()
    {
        return $this->hasMany(Project::class, 'parent_id');
    }

    // Quan hệ: Dự án cha (Thuộc dự án nào)
    public function parent()
    {
        return $this->belongsTo(Project::class, 'parent_id');
    }

    public function project_group()
    {
        return $this->belongsTo(ProjectGroup::class);
    }

    public function implementing_unit()
    {
        return $this->belongsTo(ImplementingUnit::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getOwnerNameAttribute()
    {
        // Ưu tiên 1: Nếu là dự án con -> Lấy tên đơn vị thực hiện (vì con gắn với đơn vị)
        if ($this->parent_id) {
            return $this->implementing_unit->name ?? 'Đang cập nhật đơn vị';
        }
        
        // Ưu tiên 2: Nếu là dự án cha -> Lấy tên Bộ chủ quản
        return $this->ministry->name ?? 'Đang cập nhật Bộ';
    }
    // Lấy Bộ chủ quản thực sự của dự án (dù là con hay cha)
    public function getEffectiveMinistryAttribute()
    {
        // Trường hợp 1: Dự án trực thuộc Bộ (Dự án cha)
        if ($this->ministry_id && $this->ministry) {
            return $this->ministry;
        }
        
        // Trường hợp 2: Dự án con thuộc Đơn vị -> Lấy bộ của Đơn vị đó
        if ($this->implementing_unit_id && $this->implementing_unit) {
            return $this->implementing_unit->ministry;
        }

        // Trường hợp 3: Fallback qua Parent (nếu dữ liệu cũ chưa chuẩn)
        if ($this->parent_id && $this->parent) {
            return $this->parent->effective_ministry; // Đệ quy lấy bộ của cha
        }
        
        return null;
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return 'https://placehold.co/600x400?text=No+Image';
        }

        // Nếu là URL online
        if (filter_var($this->thumbnail, FILTER_VALIDATE_URL)) {
            return $this->thumbnail;
        }

        // Xử lý đường dẫn storage
        $path = $this->thumbnail;
        
        if (strpos($path, 'public/') === 0) {
            $path = str_replace('public/', 'storage/', $path);
        }
        
        // Nếu chưa có prefix storage/ (trường hợp lưu tên file trần)
        if (strpos($path, 'storage/') === false) {
            $path = 'storage/' . $path;
        }

        return str_replace(' ', '%20', asset($path));
    }
}