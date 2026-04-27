<?php

namespace App\Livewire\Admin;

use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
    public $showInactive = true;

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

    // ✅ CORRECTION : méthode rules() dynamique au lieu de $rules statique
    // pour gérer correctement l'unicité en mode édition
    protected function rules()
    {
        $agentId = $this->editingAgent?->id ?? 'NULL';

        return [
            'form.matricule'               => 'required|string|max:20|unique:agents,matricule,' . $agentId,
            'form.nom'                     => 'required|string|max:100',
            'form.prenom'                  => 'required|string|max:100',
            'form.email'                   => 'nullable|email|unique:agents,email,' . $agentId,
            'form.telephone_professionnel' => 'nullable|string|max:25',
            'form.telephone_prive'         => 'nullable|string|max:25',
            'form.direction_id'            => 'required|exists:entities,id',
            'form.service_id'              => 'nullable|exists:entities,id',
            'form.fonction_id'             => 'required|exists:fonctions,id',
            'form.bureau'                  => 'nullable|string|max:50',
            'form.date_prise_fonction'     => 'nullable|date',
            'photo'                        => 'nullable|image|max:2048',
        ];
    }

    protected $messages = [
        'form.matricule.required'    => 'Le matricule est obligatoire.',
        'form.matricule.unique'      => 'Ce matricule existe déjà.',
        'form.nom.required'          => 'Le nom est obligatoire.',
        'form.prenom.required'       => 'Le prénom est obligatoire.',
        'form.email.email'           => "L'email n'est pas valide.",
        'form.email.unique'          => 'Cet email est déjà utilisé.',
        'form.direction_id.required' => 'La direction est obligatoire.',
        'form.direction_id.exists'   => 'La direction sélectionnée est invalide.',
        'form.fonction_id.required'  => 'La fonction est obligatoire.',
        'photo.image'                => 'Le fichier doit être une image.',
        'photo.max'                  => "L'image ne peut pas dépasser 2 MB.",
    ];

    public function mount()
    {
        $this->loadDirections();
        $this->loadFonctions();
        // ✅ CORRECTION : pas de generateMatricule() ici (mode liste, pas formulaire)
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
            // ✅ CORRECTION : parent_id au lieu de parent_uuid
            $this->services = Entity::where('parent_id', $this->form['direction_id'])
                ->where('type', 'service')
                ->where('is_active', true)
                ->orderBy('nom')
                ->get();
        } else {
            $this->services = collect();
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
        if ($this->editingAgent) return;

        $lastAgent = Agent::orderBy('created_at', 'desc')->first();
        $nextNumber = 1;
        $nextLetter = 'A';

        if ($lastAgent && $lastAgent->matricule) {
            preg_match('/(\d+)([A-Z])$/', $lastAgent->matricule, $matches);
            if ($matches) {
                $number = (int) $matches[1];
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

    public function createAgent()
    {
        $this->resetForm();
        $this->editingAgent = null;
        $this->services = collect();
        $this->generateMatricule(); // ✅ uniquement ici
        $this->showForm = true;
    }

    public function editAgent($id)
    {
        // ✅ CORRECTION : réception par $id (plus fiable que model binding avec Livewire)
        $agent = Agent::findOrFail($id);

        $this->editingAgent = $agent;
        $this->form = [
            'matricule'               => $agent->matricule,
            'nom'                     => $agent->nom,
            'prenom'                  => $agent->prenom,
            'email'                   => $agent->email,
            'telephone_professionnel' => $agent->telephone_professionnel,
            'telephone_prive'         => $agent->telephone_prive,
            'direction_id'            => $agent->entity?->parent_id ?? $agent->entity_id,
            'service_id'              => $agent->entity?->type === 'service' ? $agent->entity_id : '',
            'fonction_id'             => $agent->fonction_id,
            'bureau'                  => $agent->bureau,
            'date_prise_fonction'     => $agent->date_prise_fonction?->format('Y-m-d'),
            'is_active'               => $agent->is_active,
        ];

        $this->loadServices();
        $this->showForm = true;
    }

    public function saveAgent()
    {
        $this->validate();

        $entityId = $this->form['service_id'] ?: $this->form['direction_id'];

        $agentData = [
            'matricule'               => $this->form['matricule'],
            'nom'                     => $this->form['nom'],
            'prenom'                  => $this->form['prenom'],
            'email'                   => $this->form['email'] ?: null,
            'telephone_professionnel' => $this->form['telephone_professionnel'],
            'telephone_prive'         => $this->form['telephone_prive'],
            'entity_id'               => $entityId,
            'fonction_id'             => $this->form['fonction_id'],
            'bureau'                  => $this->form['bureau'],
            'date_prise_fonction'     => $this->form['date_prise_fonction'] ?: null,
            'is_active'               => $this->form['is_active'],
        ];

        try {
            if ($this->editingAgent) {
                $this->editingAgent->update($agentData);

                if ($this->photo) {
                    if ($this->editingAgent->photo_url) {
                        Storage::disk('public')->delete($this->editingAgent->photo_url);
                    }
                    $this->editingAgent->update([
                        'photo_url' => $this->photo->store('photos', 'public'),
                    ]);
                }

                session()->flash('message', 'Agent modifié avec succès.');

            } else {
                $agent = Agent::create($agentData);

                if ($this->photo) {
                    $agent->update([
                        'photo_url' => $this->photo->store('photos', 'public'),
                    ]);
                }

                // ✅ CORRECTION : créer le compte utilisateur uniquement si email fourni
                if ($agent->email) {
                    $generatedPassword = $this->generatePassword();

                    User::create([
                        'uuid'     => Str::uuid(),
                        'name'     => trim($agent->prenom . ' ' . $agent->nom),
                        'email'    => $agent->email,
                        'password' => Hash::make($generatedPassword),
                        'role'     => 'agent',
                        'agent_id' => $agent->id,
                    ]);

                    try {
                        Mail::to($agent->email)->send(new \App\Mail\AgentInvitation($agent, $generatedPassword));
                        session()->flash('message', 'Agent créé avec succès. Un email avec les identifiants a été envoyé.');
                    } catch (\Exception $e) {
                        Log::error('Erreur envoi mail agent: ' . $e->getMessage());
                        session()->flash('message', 'Agent créé. Mot de passe : ' . $generatedPassword . ' (email non envoyé)');
                    }
                } else {
                    session()->flash('message', 'Agent créé avec succès (sans compte utilisateur, aucun email fourni).');
                }
            }

            $this->showForm = false;
            $this->resetForm();

        } catch (\Exception $e) {
            Log::error('Erreur saveAgent: ' . $e->getMessage());
            session()->flash('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function deleteAgent($id)
    {
        try {
            $agent = Agent::findOrFail($id);

            if ($agent->photo_url) {
                Storage::disk('public')->delete($agent->photo_url);
            }

            if ($agent->user) {
                $agent->user->delete();
            }

            $agent->delete();
            session()->flash('message', 'Agent supprimé avec succès.');

        } catch (\Exception $e) {
            Log::error('Erreur deleteAgent: ' . $e->getMessage());
            session()->flash('error', 'Erreur lors de la suppression.');
        }
    }

    public function toggleActive($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->update(['is_active' => !$agent->is_active]);
        session()->flash('message', "Statut de l'agent mis à jour.");
        $this->dispatch('$refresh');
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    private function generatePassword()
    {
        // ✅ CORRECTION : random_int() plus sécurisé que rand()
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $password = '';
        for ($i = 0; $i < 12; $i++) {
            $password .= $chars[random_int(0, strlen($chars) - 1)];
        }
        return $password;
    }

    private function resetForm()
    {
        $this->form = [
            'matricule'               => '',
            'nom'                     => '',
            'prenom'                  => '',
            'email'                   => '',
            'telephone_professionnel' => '',
            'telephone_prive'         => '',
            'direction_id'            => '',
            'service_id'              => '',
            'fonction_id'             => '',
            'bureau'                  => '',
            'date_prise_fonction'     => '',
            'is_active'               => true,
        ];
        $this->photo = null;
        $this->editingAgent = null;
        $this->services = collect();
        $this->resetValidation();
    }

    public function render()
    {
        $agents = Agent::query()
            ->with(['entity', 'fonction', 'user'])
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    // ✅ CORRECTION : LIKE au lieu de ILIKE (MySQL compatible)
                    $query->where('nom', 'like', "%{$this->search}%")
                          ->orWhere('prenom', 'like', "%{$this->search}%")
                          ->orWhere('email', 'like', "%{$this->search}%")
                          ->orWhere('matricule', 'like', "%{$this->search}%");
                });
            })
            ->when($this->selectedEntity, fn($q) =>
                $q->where('entity_id', $this->selectedEntity)
            )
            ->when($this->selectedFonction, fn($q) =>
                $q->where('fonction_id', $this->selectedFonction)
            )
            ->when(!$this->showInactive, fn($q) =>
                $q->where('is_active', true)
            )
            ->orderBy('nom')
            ->paginate(15);

        return view('livewire.admin.agent-manager', [
            'agents'       => $agents,
            'allEntities'  => Entity::where('is_active', true)->orderBy('nom')->get(),
            'allFonctions' => Fonction::where('is_active', true)->orderBy('libelle')->get(),
        ]);
    }
}