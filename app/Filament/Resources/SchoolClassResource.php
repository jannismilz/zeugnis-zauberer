<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolClassResource\Pages;
use App\Filament\Resources\SchoolClassResource\RelationManagers;
use App\Models\SchoolClass;
use App\Models\SchoolClassType;
use App\Models\SubjectType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use App\Filament\Resources\BaseResource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchoolClassResource extends BaseResource
{
    protected static ?string $model = SchoolClass::class;

    protected static ?string $navigationLabel = 'Schulklassen';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Administration';
    
    protected static ?string $modelLabel = 'Schulklasse';
    
    protected static ?string $pluralModelLabel = 'Schulklassen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("school_class_type_id")
                    ->label("School Class Type")
                    ->options(SchoolClassType::all()->pluck("name", "id"))
                    ->native(false)
                    ->required(),
                TextInput::make("name")
                    ->maxLength(255)
                    ->unique()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("schoolClassType.name")
                    ->width(0),
                TextColumn::make("name"),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolClasses::route('/'),
        ];
    }
}
