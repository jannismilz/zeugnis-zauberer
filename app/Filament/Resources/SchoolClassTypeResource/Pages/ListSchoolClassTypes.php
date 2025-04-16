<?php

namespace App\Filament\Resources\AssignmentTypeResource\Pages;

use App\Filament\Resources\SchoolClassTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolClassTypes extends ListRecords
{
    protected static string $resource = SchoolClassTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
