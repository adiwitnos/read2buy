<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        <x-filament::section>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <!-- Account Info -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div>
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                            Full Name
                        </label>
                        <x-filament::input.wrapper :valid="! $errors->has('name')">
                            <x-filament::input
                                type="text"
                                wire:model="name"
                                required
                                placeholder="Your Name"
                            />
                        </x-filament::input.wrapper>
                        @error('name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                            Sign-In Email Address
                        </label>
                        <x-filament::input.wrapper :valid="! $errors->has('email')">
                            <x-filament::input
                                type="email"
                                wire:model="email"
                                required
                                placeholder="Email Address"
                            />
                        </x-filament::input.wrapper>
                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #f3f4f6;">
                    <div>
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                            New Password
                        </label>
                        <x-filament::input.wrapper :valid="! $errors->has('newPassword')">
                            <x-filament::input
                                type="password"
                                wire:model="newPassword"
                                placeholder="Minimum 8 characters (optional)"
                            />
                        </x-filament::input.wrapper>
                        @error('newPassword')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                            Confirm New Password
                        </label>
                        <x-filament::input.wrapper>
                            <x-filament::input
                                type="password"
                                wire:model="newPasswordConfirmation"
                                placeholder="Re-enter new password"
                            />
                        </x-filament::input.wrapper>
                    </div>
                </div>
            </div>

            <x-slot name="footer">
                <x-filament::button type="submit" color="primary">
                    Save Profile Changes
                </x-filament::button>
            </x-slot>
        </x-filament::section>
    </form>
</x-filament-panels::page>
