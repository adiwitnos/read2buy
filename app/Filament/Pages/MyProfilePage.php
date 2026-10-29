<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyProfilePage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static ?string $navigationLabel = 'My Profile';

    protected static ?string $title = 'My Profile';

    protected static ?int $navigationSort = 6;

    protected string $view = 'filament.pages.my-profile-page';

    public string $name = '';

    public string $email = '';

    public string $newPassword = '';

    public string $newPasswordConfirmation = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
    }

    public function save(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ];

        if (! empty($this->newPassword)) {
            $rules['newPassword'] = ['min:8', 'same:newPasswordConfirmation'];
        }

        $this->validate($rules);

        $user->name = $this->name;
        $user->email = $this->email;

        if (! empty($this->newPassword)) {
            $user->password = Hash::make($this->newPassword);
            $this->newPassword = '';
            $this->newPasswordConfirmation = '';
        }

        $user->save();

        Notification::make()
            ->title('Administrator Profile Updated Successfully')
            ->success()
            ->send();
    }
}
