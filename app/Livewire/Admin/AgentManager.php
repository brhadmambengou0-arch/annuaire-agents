<?php

namespace App\Livewire\Admin;

use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgentManager extends Component
{
    use WithFileUploads;

    // Propriétés pour la liste
    public $search = '';
    public $selectedEntity = '';
    public $selectedFonction = '';
    public $showInactive = false;

    // Propriétés pour le formulaire
    public $showForm = false;
    public $editingAgent = null;
    public $form = [
        'matricule' => '',
        'nom' => '',
        'prenom' => '',
        'email' => '',
        'telephone_professionnel' => '',
        'telephone_prive' => '',
        'direction_id' => '',
        'service_id' => '',
        'fonction_id' => '',
        'bureau' => '',
        'date_prise_fonction' => '',
        'is_active' => true,
    ];

    public $photo;

    // Propriétés pour les listes déroulantes
    public $directions = [];
    public $services = [];
    public $fonctions = [];

    protected $rules = [
        'form.matricule' => 'required|string|max:20|unique:agents,matricule',
        'form.nom' => 'required|string|max:100',
        'form.prenom' => 'required|string|max:100',
        'form.email' => 'nullable|email|unique:agents,email',
        'form.telephone_professionnel' => 'nullable|string|max:25',
        'form.telephone_prive' => 'nullable|string|max:10',
        'form.direction_id' => 'required|exists:entities,id',
        'form.service_id' => 'nullable|exists:entities,id',
        'form.fonction_id' => 'required|exists:fonctions,id',
        'form.bureau' => 'nullable|string|max:50',
        'form.date_prise_fonction' => 'nullable|date',
        'photo' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'form.matricule.required' => 'Le matricule est obligatoire.',
        'form.matricule.unique' => 'Ce matricule existe déjà.',
        'form.nom.required' => 'Le nom est obligatoire.',
        'form.prenom.required' => 'Le prénom est obligatoire.',
        'form.email.email' => 'L\'email n\'est pas valide.',
        'form.email.unique' => 'Cet email est déjà utilisé.',
        'form.direction_id.required' => 'La direction est obligatoire.',
        'form.fonction_id.required' => 'La fonction est obligatoire.',
        'photo.image' => 'Le fichier doit être une image.',
        'photo.max' => 'L\'image ne peut pas dépasser 2MB.',
    ];

    public function mount()
    {
        $this->loadDirections();
        $this->loadFonctions();
        $this->generateMatricule();
    }

    public function loadDirections()
    {
        $this->directions = Entity::where('type', 'direction')
            ->where('is_active', true)
            ->orderBy('nom')
            ->get();
    }

    public function loadServices()
    {
        if ($this->form['direction_id']) {
            $this->services = Entity::where('parent_uuid', $this->form['direction_id'])
                ->where('type', 'service')
                ->where('is_active', true)
                ->orderBy('nom')
                ->get();
        } else {
            $this->services = [];
        }
        $this->form['service_id'] = '';
    }

    public function loadFonctions()
    {
        $this->fonctions = Fonction::where('is_active', true)
            ->orderBy('libelle')
            ->get();
    }

    public function updatedFormDirectionId()
    {
        $this->loadServices();
    }

    public function generateMatricule()
    {
        if (!$this->editingAgent) {
            // Générer un matricule incrémenté : chiffre + lettre
            $lastAgent = Agent::orderBy('matricule', 'desc')->first();
            $nextNumber = 1;
            $nextLetter = 'A';

            if ($lastAgent && $lastAgent->matricule) {
                // Extraire le numéro et la lettre du dernier matricule
                preg_match('/(\d+)([A-Z])$/', $lastAgent->matricule, $matches);
                if ($matches) {
                    $number = (int)$matches[1];
                    $letter = $matches[2];

                    if ($letter === 'Z') {
                        $nextNumber = $number + 1;
                        $nextLetter = 'A';
                    } else {
                        $nextNumber = $number;
                        $nextLetter = chr(ord($letter) + 1);
                    }
                }
            }

            $this->form['matricule'] = $nextNumber . $nextLetter;
        }
    }

    public function createAgent()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingAgent = null;
        $this->generateMatricule();
    }

    public function editAgent(Agent $agent)
    {
        $this->editingAgent = $agent;
        $this->form = [
            'matricule' => $agent->matricule,
            'nom' => $agent->nom,
            'prenom' => $agent->prenom,
            'email' => $agent->email,
            'telephone_professionnel' => $agent->telephone_professionnel,
            'telephone_prive' => $agent->telephone_prive,
            'direction_id' => $agent->entity?->parent?->id ?? $agent->entity?->id,
            'service_id' => $agent->entity?->type === 'service' ? $agent->entity->id : '',
            'fonction_id' => $agent->fonction_id,
            'bureau' => $agent->bureau,
            'date_prise_fonction' => $agent->date_prise_fonction?->format('Y-m-d'),
            'is_active' => $agent->is_active,
        ];
        $this->loadServices();
        $this->showForm = true;
    }

    public function saveAgent()
    {
        // Validation personnalisée pour l'email unique (ignore l'agent actuel)
        $rules = $this->rules;
        if ($this->editingAgent) {
            $rules['form.email'] = 'nullable|email|unique:agents,email,' . $this->editingAgent->id;
            $rules['form.matricule'] = 'required|string|max:20|unique:agents,matricule,' . $this->editingAgent->id;
        }

        $this->validate($rules, $this->messages);

        // Déterminer l'entité finale (service si sélectionné, sinon direction)
        $entityId = $this->form['service_id'] ?: $this->form['direction_id'];

        $agentData = [
            'matricule' => $this->form['matricule'],
            'nom' => $this->form['nom'],
            'prenom' => $this->form['prenom'],
            'email' => $this->form['email'],
            'telephone_professionnel' => $this->form['telephone_professionnel'],
            'telephone_prive' => $this->form['telephone_prive'],
            'entity_id' => $entityId,
            'fonction_id' => $this->form['fonction_id'],
            'bureau' => $this->form['bureau'],
            'date_prise_fonction' => $this->form['date_prise_fonction'],
            'is_active' => $this->form['is_active'],
        ];

        if ($this->editingAgent) {
            $this->editingAgent->update($agentData);

            // Gérer la photo
            if ($this->photo) {
                if ($this->editingAgent->photo_url) {
                    \Storage::disk('public')->delete($this->editingAgent->photo_url);
                }
                $path = $this->photo->store('photos', 'public');
                $this->editingAgent->update(['photo_url' => $path]);
            }

            session()->flash('message', 'Agent modifié avec succès.');
        } else {
            $agent = Agent::create($agentData);

            // Gérer la photo
            if ($this->photo) {
                $path = $this->photo->store('photos', 'public');
                $agent->update(['photo_url' => $path]);
            }

            // Créer le compte utilisateur avec mot de passe généré
            $generatedPassword = $this->generatePassword();
            $user = User::create([
                'uuid' => Str::uuid(),
                'name' => $agent->nom_complet,
                'email' => $agent->email,
                'password' => Hash::make($generatedPassword),
                'role' => 'agent',
                'agent_id' => $agent->id,
            ]);

            // Envoyer l'email d'invitation avec le mot de passe
            try {
                \Mail::to($agent->email)->send(new \App\Mail\AgentInvitation($agent, $generatedPassword));
                session()->flash('message', 'Agent créé avec succès. Un email avec les identifiants a été envoyé.');
            } catch (\Exception $e) {
                session()->flash('message', 'Agent créé avec succès. Mot de passe généré : ' . $generatedPassword . ' (Erreur d\'envoi email)');
            }
        }

        $this->showForm = false;
        $this->resetForm();
    }

    public function deleteAgent(Agent $agent)
    {
        // Supprimer la photo si elle existe
        if ($agent->photo_url) {
            \Storage::disk('public')->delete($agent->photo_url);
        }

        // Supprimer l'utilisateur associé
        if ($agent->user) {
            $agent->user->delete();
        }

        $agent->delete();
        session()->flash('message', 'Agent supprimé avec succès.');
    }

    public function toggleActive(Agent $agent)
    {
        $agent->update(['is_active' => !$agent->is_active]);
        session()->flash('message', 'Statut de l\'agent mis à jour.');
    }

    private function generatePassword()
    {
        // Générer un mot de passe de 12 caractères avec lettres, chiffres et symboles
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $password = '';
        for ($i = 0; $i < 12; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    private function resetForm()
    {
        $this->form = [
            'matricule' => '',
            'nom' => '',
            'prenom' => '',
            'email' => '',
            'telephone_professionnel' => '',
            'telephone_prive' => '',
            'direction_id' => '',
            'service_id' => '',
            'fonction_id' => '',
            'bureau' => '',
            'date_prise_fonction' => '',
            'is_active' => true,
        ];
        $this->photo = null;
        $this->resetValidation();
    }

    public function render()
    {
        $agents = Agent::query()
            ->with(['entity', 'fonction', 'user'])
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('nom', 'ILIKE', "%{$this->search}%")
                          ->orWhere('prenom', 'ILIKE', "%{$this->search}%")
                          ->orWhere('email', 'ILIKE', "%{$this->search}%")
                          ->orWhere('matricule', 'ILIKE', "%{$this->search}%");
                });
            })
            ->when($this->selectedEntity, function ($q) {
                $q->where('entity_id', $this->selectedEntity);
            })
            ->when($this->selectedFonction, function ($q) {
                $q->where('fonction_id', $this->selectedFonction);
            })
            ->when(!$this->showInactive, function ($q) {
                $q->where('is_active', true);
            })
            ->orderBy('nom')
            ->paginate(15);

        return view('livewire.admin.agent-manager', [
            'agents' => $agents,
            'allEntities' => Entity::where('is_active', true)->orderBy('nom')->get(),
            'allFonctions' => Fonction::where('is_active', true)->orderBy('libelle')->get(),
        ]);
    }
}
