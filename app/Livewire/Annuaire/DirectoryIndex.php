<?php

namespace App\Livewire\Annuaire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;
use App\Models\User;
use App\Mail\AgentInvitation;
use Illuminate\Support\Facades\Mail;

class DirectoryIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    protected $listeners = [
        'open-edit' => 'openEdit',
    ];

    //  Recherche & filtres
    public $search = '';
    public $directionId = null;
    public $entityId = null;
    public $fonctionId = null;

    //  Modal
    public $showDetail = false;
    public $showForm = false;

    //  Agent sélectionné
    public $selectedAgent = null;
    public $agentId = null;

    //  Formulaire
    public $matricule;
    public $nom;
    public $prenom;
    public $email;
    public $telephone;
    public $telephone_interne;
    public $bureau;
    public $date_prise_fonction;
    public $selectedDirectionId;
    public $fonctionIdForm;

    protected $rules = [
        'matricule' => 'required|string|max:50',
        'nom' => 'required|string|max:100',
        'prenom' => 'required|string|max:100',
        'email' => 'nullable|email',
        'entityId' => 'required|exists:entities,id',
        'fonctionIdForm' => 'required|exists:fonctions,id',
    ];

    // Reset pagination si recherche change
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDirectionId()
    {
        $this->resetPage();
        $this->entityId = null;
        $this->fonctionId = null;
    }

    public function updatingEntityId()
    {
        $this->resetPage();
        $this->fonctionId = null;
    }

    public function updatingFonctionId()
    {
        $this->resetPage();
    }

    //  Données calculées

    public function getAgentsProperty()
    {
        return Agent::query()
            ->with(['fonction', 'entity'])
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('nom', 'ilike', "%{$this->search}%")
                       ->orWhere('prenom', 'ilike', "%{$this->search}%")
                       ->orWhere('email', 'ilike', "%{$this->search}%")
                       ->orWhere('matricule', 'ilike', "%{$this->search}%");
                });
            })
            ->when($this->directionId, function ($q) {
                $q->whereHas('entity', function ($e) {
                    $e->where('parent_id', $this->directionId)
                      ->orWhere('id', $this->directionId);
                });
            })
            ->when($this->entityId, function ($q) {
                $q->where('entity_id', $this->entityId);
            })
            ->when($this->fonctionId, function ($q) {
                $q->where('fonction_id', $this->fonctionId);
            })
            ->orderBy('nom')
            ->paginate(24);
    }

    public function getFonctionsProperty()
    {
        return Fonction::when($this->directionId, function ($query) {
                $query->whereHas('agents.entity', function ($query) {
                    $query->where('parent_id', $this->directionId)
                          ->orWhere('id', $this->directionId);
                });
            })
            ->when($this->entityId, function ($query) {
                $query->whereHas('agents', function ($query) {
                    $query->where('entity_id', $this->entityId);
                });
            })
            ->orderBy('niveau')
            ->get();
    }

    public function getServicesProperty()
    {
        if ($this->directionId) {
            return Entity::where('parent_id', $this->directionId)
                         ->orderBy('nom')
                         ->get();
        }

        return Entity::where('type', 'service')
                     ->orderBy('nom')
                     ->get();
    }

    public function getAllEntitiesProperty()
    {
        return Entity::orderBy('nom')->get();
    }

    public function getEntitiesByDirectionProperty()
    {
        if ($this->selectedDirectionId) {
            return Entity::where('parent_id', $this->selectedDirectionId)
                        ->orWhere('id', $this->selectedDirectionId)
                        ->orderBy('nom')
                        ->get();
        }
        return collect();
    }

    public function getEntityTreeProperty()
    {
        return Entity::whereNull('parent_id')
            ->with('children.children')
            ->get();
    }

    //  Actions

    public function resetFilters()
    {
        $this->reset(['search', 'directionId', 'entityId', 'fonctionId']);
    }

    // Détail
    public function openDetail($id)
    {
        $this->selectedAgent = Agent::with(['fonction', 'entity.parent.parent'])->findOrFail($id);
        $this->showDetail = true;
    }

    public function closeDetail()
    {
        $this->showDetail = false;
        $this->selectedAgent = null;
    }

    //  Création
    public function openCreate()
    {
        $this->resetForm();
        $this->showForm = true;
    }

    //  Edition
    public function openEdit($id)
    {
        $agent = Agent::with('entity.parent')->findOrFail($id);

        $this->agentId = $agent->id;
        $this->matricule = $agent->matricule;
        $this->nom = $agent->nom;
        $this->prenom = $agent->prenom;
        $this->email = $agent->email;
        $this->telephone = $agent->telephone;
        $this->telephone_interne = $agent->telephone_interne;
        $this->bureau = $agent->bureau;
        $this->date_prise_fonction = $agent->date_prise_fonction;
        $this->entityId = $agent->entity_id;
        $this->fonctionIdForm = $agent->fonction_id;

        // Définir la direction basée sur l'entité
        if ($agent->entity) {
            $this->selectedDirectionId = $agent->entity->parent_id ?? $agent->entity_id;
        }

        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'agentId',
            'matricule',
            'nom',
            'prenom',
            'email',
            'telephone',
            'telephone_interne',
            'bureau',
            'date_prise_fonction',
            'selectedDirectionId',
            'entityId',
            'fonctionIdForm',
        ]);
    }

    // Sauvegarde
    public function save()
    {
        $this->validate();

        // Créer l'agent
        $agent = Agent::updateOrCreate(
            ['id' => $this->agentId],
            [
                'matricule' => $this->matricule,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'email' => $this->email,
                'telephone' => $this->telephone,
                'telephone_interne' => $this->telephone_interne,
                'bureau' => $this->bureau,
                'date_prise_fonction' => $this->date_prise_fonction,
                'entity_id' => $this->entityId,
                'fonction_id' => $this->fonctionIdForm,
            ]
        );

        // ← AJOUT : créer automatiquement un compte utilisateur si c'est une création
        if (!$this->agentId && $agent->email) {
            // Générer un mot de passe temporaire
            $tempPassword = 'Temp' . rand(1000, 9999) . '!';

            // Créer le compte utilisateur
            $user = User::create([
                'name' => $agent->prenom . ' ' . $agent->nom,
                'email' => $agent->email,
                'password' => bcrypt($tempPassword),
                'role' => 'consultant', // rôle par défaut pour les agents
                'agent_id' => $agent->id,
             ]);

            // Envoyer l'email d'invitation
            try {
                Mail::to($agent->email)->send(new AgentInvitation($agent, $tempPassword));
            } catch (\Exception $e) {
                // Log the error but don't fail the creation
                \Log::error('Failed to send invitation email: ' . $e->getMessage());
            }
        }

        $this->closeForm();

        // ← AJOUT : message de succès avec info sur le compte créé
        if (!$this->agentId) {
            session()->flash('success',
                'Agent créé avec succès ! ' .
                ($agent->email ? 'Un compte utilisateur a été créé avec l\'email : ' . $agent->email : '')
            );
        } else {
            session()->flash('success', 'Agent modifié avec succès.');
        }
    }

    // Activer / désactiver
    public function toggleActive($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->is_active = !$agent->is_active;
        $agent->save();

        $this->openDetail($id);
    }

    //  Render
    public function render()
    {
        return view('livewire.annuaire.directory-index', [
            'agents' => $this->agents,
            'fonctions' => $this->fonctions,
            'allEntities' => $this->allEntities,
            'entityTree' => $this->entityTree,
            'directions' => Entity::where('type','direction')->whereNull('parent_id')->orderBy('nom')->get(),
            'services' => $this->services,
            ]);
    }
}