<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentTypeResource\Pages;
use App\Models\SubjectType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use App\Filament\Resources\BaseResource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubjectTypeResource extends BaseResource
{
    protected static ?string $model = SubjectType::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Fachtypen';
    protected static ?string $navigationGroup = 'Parameter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->maxLength(255)
                    ->unique()
                    ->columnSpanFull()
                    ->required()
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
            'index' => Pages\ListSubjectTypes::route('/'),
        ];
    }
}
