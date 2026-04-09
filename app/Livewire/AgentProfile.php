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
    public $email;
    public $telephone_professionnel;
    public $telephone_prive;
    public $current_password;
    public $password;
    public $password_confirmation;
    public $photo;

    protected $rules = [
        'email' => 'required|email|unique:agents,email',
        'telephone_professionnel' => 'nullable|string|max:25',
        'telephone_prive' => 'nullable|string|max:10',
        'current_password' => 'required_with:password',
        'password' => 'nullable|min:8|confirmed',
        'photo' => 'nullable|image|max:2048',
    ];

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
        $this->agent = Auth::user()->agent;
        $this->email = $this->agent->email;
        $this->telephone_professionnel = $this->agent->telephone_professionnel;
        $this->telephone_prive = $this->agent->telephone_prive;
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function updatedPhoto()
    {
        $this->validateOnly('photo');
    }

    public function saveProfile()
    {
        // Validation personnalisée pour l'email unique (ignore l'agent actuel)
        $this->rules['email'] = 'required|email|unique:agents,email,' . $this->agent->id;

        $validated = $this->validate();

        // Vérifier le mot de passe actuel si on change le mot de passe
        if (!empty($validated['password'])) {
            if (!Hash::check($this->current_password, Auth::user()->password)) {
                $this->addError('current_password', 'Le mot de passe actuel est incorrect.');
                return;
            }
        }

        // Mettre à jour l'agent
        $this->agent->update([
            'email' => $validated['email'],
            'telephone_professionnel' => $validated['telephone_professionnel'],
            'telephone_prive' => $validated['telephone_prive'],
        ]);

        // Mettre à jour la photo si fournie
        if ($this->photo) {
            // Supprimer l'ancienne photo
            if ($this->agent->photo_url) {
                Storage::disk('public')->delete($this->agent->photo_url);
            }

            // Sauvegarder la nouvelle photo
            $path = $this->photo->store('photos', 'public');
            $this->agent->update(['photo_url' => $path]);
        }

        // Mettre à jour le mot de passe si fourni
        if (!empty($validated['password'])) {
            Auth::user()->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        // Reset des champs de mot de passe
        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';

        session()->flash('message', 'Profil mis à jour avec succès.');
    }

    public function render()
    {
        return view('livewire.agent-profile');
    }
}
