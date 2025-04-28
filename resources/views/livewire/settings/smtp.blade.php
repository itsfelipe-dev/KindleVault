<x-form-section submit="saveSmtpSettings">
    <x-slot name="title">
        {{ __('Smtp Settings') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Configure your SMTP settings to enable email sending from your application.') }}
    </x-slot>
    <x-slot name="form">
        <!-- Host Input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="host" value="{{ __('SMTP Host') }}" />
            <x-input id="host" type="text" class="block w-full mt-1" wire:model="host"
                value="{{ old('host', $host) }}" />
            <x-input-error for="host" class="mt-2" />
        </div>

        <!-- Port Input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="port" value="{{ __('SMTP Port') }}" />
            <x-input id="port" type="number" class="block w-full mt-1" wire:model="port"
                value="{{ old('port', $port) }}" />
            <x-input-error for="port" class="mt-2" />
        </div>

        <!-- Username Input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="username" value="{{ __('SMTP Username') }}" />
            <x-input id="username" type="text" class="block w-full mt-1" wire:model="username"
                value="{{ old('username', $username) }}" />
            <x-input-error for="username" class="mt-2" />
        </div>

        <!-- Password Input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('SMTP Password') }}" />
            <x-input id="password" type="password" class="block w-full mt-1" wire:model="password"
                value="{{ old('password', $password) }}" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <!-- Encryption Input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="encryption" value="{{ __('Encryption') }}" />
            <x-input id="encryption" type="text" class="block w-full mt-1" wire:model="encryption"
                value="{{ old('encryption', $encryption) }}" />
            <x-input-error for="encryption" class="mt-2" />
        </div>

        <!-- Sender Email Input -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="sender_email" value="{{ __('Sender Email') }}" />
            <x-input id="sender_email" type="email" class="block w-full mt-1" wire:model="sender_email"
                value="{{ old('sender_email', $sender_email) }}" />
            <x-input-error for="sender_email" class="mt-2" />
        </div>
    </x-slot>



    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
