<?php

namespace App\Livewire\Pages\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class DeleteUserModal extends Component
{
    public string $password = '';

    public function deleteUser(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        /** @var User $user */
        $user = auth()->user();

        Auth::logout();

        $user->delete();

        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.pages.settings.delete-user-modal');
    }
}