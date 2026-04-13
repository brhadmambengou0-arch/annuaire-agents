<?php

namespace App\Livewire;

use App\Models\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgentProfile extends Component
{
    use WithFileUploads;

    public $agent;
    public $name;
    public $email;
    public $telephone_professionnel;
    public $telephone_prive;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $photo;
    public $showPassword = false;
    public $editMode = false;

    protected function rules(): array
    {
        $agentId = $this->agent?->id;

        return [
            'email' => 'required|email|unique:agents,email' . ($agentId ? ",{$agentId}" : ''),
            'telephone_professionnel' => 'nullable|string|max:25',
            'telephone_prive' => 'nullable|string|max:10',
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|max:2048',
        ];
    }

    protected $messages = [
        'email.required' => 'L\'email est obligatoire.',
        'email.email' => 'L\'email n\'est pas valide.',
        'email.unique' => 'Cet email est déjà utilisé.',
        'telephone_professionnel.max' => 'Le téléphone professionnel ne peut pas dépasser 25 caractères.',
        'telephone_prive.max' => 'Le téléphone privé ne peut pas dépasser 10 caractères.',
        'current_password.required_with' => 'Le mot de passe actuel est requis pour changer le mot de passe.',
        'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
        'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        'photo.image' => 'Le fichier doit être une image.',
        'photo.max' => 'L\'image ne peut pas dépasser 2MB.',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->agent = $user->agent;
        $this->name = $user->name;
        $this->email = optional($this->agent)->email ?? $user->email;
        $this->telephone_professionnel = optional($this->agent)->telephone;
        $this->telephone_prive = optional($this->agent)->telephone_interne;
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function updatedPhoto()
    {
        $this->validateOnly('photo');
    }

    public function enableEditing()
    {
        $this->editMode = true;
    }

    public function cancelEditing()
    {
        $this->editMode = false;
        $this->mount();
        $this->reset(['current_password', 'password', 'password_confirmation', 'photo']);
    }

    public function saveProfile()
    {
        $validated = $this->validate();

        $updateData = [
            'email' => $validated['email'],
            'telephone' => $validated['telephone_professionnel'],
            'telephone_interne' => $validated['telephone_prive'],
        ];

        if ($this->photo && $this->agent) {
            Storage::disk('public')->makeDirectory('agents/photos');

            if ($this->agent->photo_url) {
                Storage::disk('public')->delete($this->agent->photo_url);
            }

            $updateData['photo_url'] = $this->photo->store('agents/photos', 'public');
        }

        if ($this->agent) {
            $this->agent->update($updateData);

            if ($this->agent->user) {
                $this->agent->user->update(['email' => $validated['email']]);
            }
        } else {
            Auth::user()->update(['email' => $validated['email']]);
        }

        if (!empty($validated['password'])) {
            if (!Hash::check($this->current_password, Auth::user()->password)) {
                $this->addError('current_password', 'Le mot de passe actuel est incorrect.');
                return;
            }

            Auth::user()->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->editMode = false;

        $photoUrl = null;
        if ($this->agent && $this->agent->photo_url) {
            $photoUrl = asset('storage/' . $this->agent->photo_url);
        }

        session()->flash('message', 'Profil mis à jour avec succès.');
    }

    public function render()
    {
        return view('livewire.agent-profile');
    }
}
