<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssignmentResource\Pages;
use App\Models\Assignment;
use App\Models\AssignmentType;
use App\Models\SchoolClass;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use App\Filament\Resources\BaseResource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AssignmentResource extends BaseResource
{
    protected static ?string $model = Assignment::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Prüfungen';

    protected static ?string $navigationGroup = 'Noten';
    
    protected static ?string $modelLabel = 'Prüfung';
    
    protected static ?string $pluralModelLabel = 'Prüfungen';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('school_class_id')
                                    ->label('Klasse')
                                    ->options(SchoolClass::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('subject_id')
                                    ->label('Fach')
                                    ->options(Subject::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('assignment_type_id')
                                    ->label('Typ')
                                    ->options(AssignmentType::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('weight')
                                    ->label('Gewichtung')
                                    ->numeric()
                                    ->required()
                                    ->default(1.0)
                                    ->step(0.1)
                                    ->minValue(0.1)
                                    ->maxValue(10),
                            ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('schoolClass.name')
                    ->label('Klasse')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Fach')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignmentType.name')
                    ->label('Typ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school_class_id')
                    ->label('Klasse')
                    ->options(SchoolClass::all()->pluck('name', 'id'))
                    ->native(false),
                Tables\Filters\SelectFilter::make('subject_id')
                    ->label('Fach')
                    ->options(Subject::all()->pluck('name', 'id'))
                    ->native(false),
                Tables\Filters\SelectFilter::make('assignment_type_id')
                    ->label('Typ')
                    ->options(AssignmentType::all()->pluck('name', 'id'))
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAssignments::route('/'),
            'create' => Pages\CreateAssignment::route('/create'),
            'edit' => Pages\EditAssignment::route('/{record}/edit'),
        ];
    }
}
