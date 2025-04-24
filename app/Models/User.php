<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\Traits\Creator;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'apprentice_start',
        'location_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'apprentice_start' => 'datetime'
        ];
    }

    // All existing users can access the panel
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getApprenticeYearAttribute(): int|null {
        if (!$this->isApprentice()) {
            return null;
        }

        return $this->apprentice_start->diffInYears(Carbon::now()) + 1;
    }
    
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    
    public function isApprentice(): bool
    {
        return $this->apprentice_start !== null;
    }
}
