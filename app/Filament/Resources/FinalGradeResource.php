<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinalGradeResource\Pages;
use App\Models\FinalGrade;
use App\Models\FinalGradeType;
use App\Models\Subject;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use App\Filament\Resources\BaseResource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FinalGradeResource extends BaseResource
{
    protected static ?string $model = FinalGrade::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Zeugnisnoten';

    protected static ?string $navigationGroup = 'Noten';

    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('Lernender')
                                    ->options(User::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('subject_id')
                                    ->label('Fach')
                                    ->options(Subject::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('final_grade_type_id')
                                    ->label('Typ')
                                    ->options(FinalGradeType::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                            ]),
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('grade')
                                    ->label('Note')
                                    ->numeric()
                                    ->required()
                                    ->step(0.1)
                                    ->minValue(1.0)
                                    ->maxValue(6.0),
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Lernender')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Fach')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('finalGradeType.name')
                    ->label('Typ')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade')
                    ->label('Note')
                    ->numeric(1)
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->label('Gewichtung')
                    ->numeric(1)
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
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Lernender')
                    ->options(User::all()->pluck('name', 'id'))
                    ->native(false),
                Tables\Filters\SelectFilter::make('subject_id')
                    ->label('Fach')
                    ->options(Subject::all()->pluck('name', 'id'))
                    ->native(false),
                Tables\Filters\SelectFilter::make('final_grade_type_id')
                    ->label('Typ')
                    ->options(FinalGradeType::all()->pluck('name', 'id'))
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
            'index' => Pages\ListFinalGrades::route('/'),
            'create' => Pages\CreateFinalGrade::route('/create'),
            'edit' => Pages\EditFinalGrade::route('/{record}/edit'),
        ];
    }
}
