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
}