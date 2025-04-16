<?php

namespace App\Filament\Resources\AssignmentTypeResource\Pages;

use App\Filament\Resources\FinalGradeTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinalGradeTypes extends ListRecords
{
    protected static string $resource = FinalGradeTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
