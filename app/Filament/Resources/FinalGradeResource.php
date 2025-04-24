<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinalGradeResource\Pages;
use App\Models\FinalGrade;
use App\Models\FinalGradeType;
use App\Models\Subject;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FinalGradeResource extends Resource
{
    protected static ?string $model = FinalGrade::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Grades';

    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('Student')
                                    ->options(User::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                                Forms\Components\Select::make('subject_id')
                                    ->label('Subject')
                                    ->options(Subject::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                                Forms\Components\Select::make('final_grade_type_id')
                                    ->label('Final Grade Type')
                                    ->options(FinalGradeType::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('grade')
                            ->label('Grade')
                            ->numeric()
                            ->required()
                            ->step(0.1)
                            ->minValue(1.0)
                            ->maxValue(6.0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Student')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Subject')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('finalGradeType.name')
                    ->label('Final Grade Type')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade')
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
                    ->label('Student')
                    ->options(User::all()->pluck('name', 'id')),
                Tables\Filters\SelectFilter::make('subject_id')
                    ->label('Subject')
                    ->options(Subject::all()->pluck('name', 'id')),
                Tables\Filters\SelectFilter::make('final_grade_type_id')
                    ->label('Final Grade Type')
                    ->options(FinalGradeType::all()->pluck('name', 'id')),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
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
