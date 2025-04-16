<?php

namespace App\Filament\Resources\AssignmentTypeResource\Pages;

use App\Filament\Resources\AssignmentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssignmentTypes extends ListRecords
{
    protected static string $resource = AssignmentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
