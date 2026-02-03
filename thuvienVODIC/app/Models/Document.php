<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title', 
        'project_id', 
        'file_path', 
        'type', 
        'size',
        'uploaded_by'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function uploader() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
