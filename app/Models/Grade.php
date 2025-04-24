<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    protected $fillable = [
        'user_id',
        'assignment_id',
        'grade',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }
}
