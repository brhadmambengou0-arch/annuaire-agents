<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public string $name  = '';
    public string $email = '';

    public function mount(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->name  = $user->name;
        $this->email = $user->email;
    }

    public function render()
    {
        return view('livewire.settings.profile');
    }
}