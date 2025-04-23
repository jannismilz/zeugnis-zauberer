<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\Traits\Creator;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use SoftDeletes;

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

    public function getApprenticeYearAttribute(): int {
        return $this->apprentice_start->diffInYears(Carbon::now()) + 1;
    }
}
