<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentTypeResource\Pages;
use App\Models\SchoolClassType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolClassTypeResource extends Resource
{
    protected static ?string $model = SchoolClassType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Parameter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->maxLength(255)
                    ->unique()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               TextColumn::make('name')
                    ->searchable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolClassTypes::route('/'),
        ];
    }
}
