<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolClass extends Model
{
    public function schoolClassType(): BelongsTo {
        return $this->belongsTo(SchoolClassType::class);
    }
}
