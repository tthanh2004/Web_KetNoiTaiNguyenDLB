<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title', 
        'author_org', 
        'file_url', 
        'type', 
        'user_id', // Admin upload
        'project_id'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function uploader() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
