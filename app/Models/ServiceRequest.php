<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    // Added document_path so file uploads actually save!
    protected $fillable = ['type', 'description', 'status', 'user_id', 'document_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}