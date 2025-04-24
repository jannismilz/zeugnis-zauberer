<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model
{
    protected $fillable = [
        'school_class_id',
        'subject_id',
        'assignment_type_id',
        'name',
        'weight',
    ];
    
    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }
    
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
    
    public function assignmentType(): BelongsTo
    {
        return $this->belongsTo(AssignmentType::class);
    }
    
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
