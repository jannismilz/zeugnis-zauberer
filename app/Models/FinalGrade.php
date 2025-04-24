<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinalGrade extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'final_grade_type_id',
        'grade',
        'weight',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function finalGradeType(): BelongsTo
    {
        return $this->belongsTo(FinalGradeType::class);
    }
}
