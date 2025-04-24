<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;

abstract class BaseResource extends Resource
{
    public static function canCreate(): bool
    {
        return auth()->user()->isApprentice();
    }
    
    public static function canEdit(Model $record): bool
    {
        return auth()->user()->isApprentice();
    }
    
    public static function canDelete(Model $record): bool
    {
        return auth()->user()->isApprentice();
    }
    
    public static function canViewAny(): bool
    {
        // If user is an apprentice, they can view all resources
        if (auth()->user()->isApprentice()) {
            return true;
        }
        
        // For non-apprentice users, only show resources in the Noten group
        $navigationGroup = static::getNavigationGroup();
        
        return $navigationGroup === 'Noten';
    }
}
