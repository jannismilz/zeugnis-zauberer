<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Subject;
use App\Models\SubjectType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use App\Filament\Resources\BaseResource;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubjectResource extends BaseResource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Administration';
    protected static ?string $navigationLabel = 'Fächer';
    
    protected static ?string $modelLabel = 'Fach';
    
    protected static ?string $pluralModelLabel = 'Fächer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make("subject_type_id")
                    ->label("Subject Type")
                    ->options(SubjectType::all()->pluck("name", "id"))
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
                TextColumn::make("subjectType.name")
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
            'index' => Pages\ListSubjects::route('/'),
        ];
    }
}
