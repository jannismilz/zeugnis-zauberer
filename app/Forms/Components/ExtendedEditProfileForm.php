<?php

namespace App\Forms\Components;

use App\Models\Location;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Joaopaulolndev\FilamentEditProfile\Livewire\EditProfileForm;

class ExtendedEditProfileForm extends EditProfileForm
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill($this->user->only('name', 'email', 'apprentice_start', 'location_id'));
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('filament-edit-profile::default.profile_information'))
                    ->aside()
                    ->description(__('filament-edit-profile::default.profile_information_description'))
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required(),
                            
                        TextInput::make('email')
                            ->label(__('filament-edit-profile::default.email'))
                            ->email()
                            ->required()
                            ->unique($this->userClass, ignorable: $this->user),
                            
                        Select::make('location_id')
                            ->label('Location')
                            ->options(Location::all()->pluck('name', 'id'))
                            ->searchable()
                            ->native(false),
                            
                        DatePicker::make('apprentice_start')
                            ->label('Apprenticeship Start Date')
                            ->displayFormat('d.m.Y')
                            ->native(false),
                    ]),
            ])
            ->statePath('data');
    }
}
