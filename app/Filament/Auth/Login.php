<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Forms\Form;

class Login extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        return parent::authenticate();
    }

    protected function getCredentialsFromFormData(array $data): array
    { 
        return [
            'username' => $data['username'],
            'password'  => $data['password'],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getUsernameFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getUsernameFormComponent(): \Filament\Forms\Components\TextInput
    {
        return \Filament\Forms\Components\TextInput::make('username')
            ->label('Benutzername')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.username' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
