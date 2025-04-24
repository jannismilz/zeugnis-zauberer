<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Models\Assignment;
use App\Models\Grade;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use App\Filament\Resources\BaseResource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class GradeResource extends BaseResource
{
    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    protected static ?string $navigationGroup = 'Noten';

    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('Lernender')
                                    ->options(User::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('assignment_id')
                                    ->label('Prüfung')
                                    ->options(Assignment::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                            ]),
                        Forms\Components\TextInput::make('grade')
                            ->label('Note')
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
                    ->label('Lernender')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignment.name')
                    ->label('Prüfung')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignment.subject.name')
                    ->label('Fach')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade')
                    ->label('Note')
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
                Tables\Filters\SelectFilter::make('assignment_id')
                    ->label('Prüfung')
                    ->options(Assignment::all()->pluck('name', 'id'))
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
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),
        ];
    }
}
