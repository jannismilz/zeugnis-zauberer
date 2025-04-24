<?php

namespace App\Filament\Resources\FinalGradeResource\Pages;

use App\Filament\Resources\FinalGradeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFinalGrades extends ListRecords
{
    protected static string $resource = FinalGradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
