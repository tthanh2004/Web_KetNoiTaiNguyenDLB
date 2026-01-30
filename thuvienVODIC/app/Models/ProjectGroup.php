<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class ProjectGroup extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
