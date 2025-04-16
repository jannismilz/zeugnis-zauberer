<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subject extends Model
{
    public function subjectType(): BelongsTo {
        return $this->belongsTo(SubjectType::class);
    }
}
