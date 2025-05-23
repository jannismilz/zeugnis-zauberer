<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Location;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use App\Filament\Resources\BaseResource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class UserResource extends BaseResource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Administration';
    
    protected static ?string $modelLabel = 'Benutzer';
    
    protected static ?string $pluralModelLabel = 'Benutzer';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('username')
                    ->label('Benutzername')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('email')
                    ->label('E-Mail')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')
                    ->label('Passwort')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->maxLength(255)
                    ->dehydrated(fn ($state) => filled($state)),
                Forms\Components\Select::make('location_id')
                    ->label('Standort')
                    ->options(Location::all()->pluck('name', 'id'))
                    ->searchable()
                    ->native(false)
                    ->required(),
                Forms\Components\DatePicker::make('apprentice_start')
                    ->label('Lehrbeginn')
                    ->displayFormat('d.m.Y')
                    ->native(false),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label('Name')
                    ->searchable(),
                TextColumn::make("username")
                    ->label('Benutzername')
                    ->searchable(),
                TextColumn::make("location.name")
                    ->label('Standort')
                    ->sortable()
                    ->searchable(),
                TextColumn::make("apprenticeYear")
                    ->label('Lehrjahr')
                    ->numeric()
                    ->sortable()
            ])
            ->actions([
                EditAction::make()
                    ->accessSelectedRecords()
                    ->visible(function (Model $record, Collection $selectedRecords) {
                        return $record->id === auth()->user()->id;
                    })
                    ->url('/me'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
