<?php

namespace App\Forms\Components;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Joaopaulolndev\FilamentEditProfile\Livewire\EditProfileForm;

class ExtendedEditProfileForm extends EditProfileForm
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill($this->user->only('name', 'email', 'apprentice_start'));
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
                            
                        DatePicker::make('apprentice_start')
                            ->label('Apprenticeship Start Date')
                            ->displayFormat('d.m.Y')
                            ->native(false),
                    ]),
            ])
            ->statePath('data');
    }
}
