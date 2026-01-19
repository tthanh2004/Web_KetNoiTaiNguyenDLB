<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataRequest extends Model
{
    protected $fillable = [
        'fullname', 
        'email', 
        'organization', 
        'phone', 
        'content', 
        'status', 
        'processed_by_user_id' // Admin xử lý
    ];

    public function processor() {
        return $this->belongsTo(User::class, 'processed_by_user_id');
    }
}
