<?php

namespace App\Livewire\Annuaire;

use App\Models\Agent;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AgentForm extends Component
{
    public bool $showModal = false;
    public ?int $agentId = null;

    #[Validate('required|string|max:20|unique:agents,matricule')]
    public string $matricule = '';

    #[Validate('required|string|max:100')]
    public string $nom = '';

    #[Validate('required|string|max:100')]
    public string $prenom = '';

    #[Validate('nullable|email|max:150|unique:agents,email')]
    public string $email = '';

    #[Validate('nullable|string|max:25')]
    public string $telephone = '';

    #[Validate('nullable|string|max:10')]
    public string $telephone_interne = '';

    #[Validate('nullable|string|max:50')]
    public string $bureau = '';

    #[Validate('nullable|date')]
    public string $date_prise_fonction = '';

    #[Validate('required|exists:entities,id')]
    public ?int $entityId = null;

    #[Validate('required|exists:fonctions,id')]
    public int $fonctionId = 1;

    #[On('open-agent-form')]
    public function open(?int $agentId = null): void
    {
        $this->reset();
        $this->fonctionId = 1;

        if ($agentId) {
            $agent = Agent::findOrFail($agentId);
            $this->agentId  = $agent->id;
            $this->matricule = $agent->matricule;
            $this->nom       = $agent->nom;
            $this->prenom    = $agent->prenom;
            $this->email     = $agent->email ?? '';
            $this->telephone = $agent->telephone ?? '';
            $this->telephone_interne = $agent->telephone_interne ?? '';
            $this->bureau    = $agent->bureau ?? '';
            $this->date_prise_fonction = $agent->date_prise_fonction?->format('Y-m-d') ?? '';
            $this->entityId  = $agent->entity_id;
            $this->fonctionId = $agent->fonction_id;

            // En modification, ignore l'unicité sur l'enregistrement lui-même
            $this->resetValidation();
        }

        $this->showModal = true;
    }

    public function save(): void
    {
        // Adapte les règles d'unicité en mode édition
        $rules = $this->getRules();
        if ($this->agentId) {
            $rules['matricule'] = 'required|string|max:20';
            $rules['email']     = "nullable|email|max:150|unique:agents,email,{$this->agentId}";
        }
        $this->validate($rules);

        $data = [
            'nom'                 => strtoupper(trim($this->nom)),
            'prenom'              => ucwords(strtolower(trim($this->prenom))),
            'email'               => $this->email ?: null,
            'telephone'           => $this->telephone ?: null,
            'telephone_interne'   => $this->telephone_interne ?: null,
            'bureau'              => $this->bureau ?: null,
            'date_prise_fonction' => $this->date_prise_fonction ?: null,
            'entity_id'           => $this->entityId,
            'fonction_id'         => $this->fonctionId,
        ];

        if ($this->agentId) {
            Agent::findOrFail($this->agentId)->update($data);
            $message = 'Agent modifié avec succès.';
        } else {
            $data['matricule'] = strtoupper(trim($this->matricule));
            Agent::create($data);
            $message = 'Agent créé avec succès.';
        }

        $this->showModal = false;
        $this->dispatch('agent-saved');
        session()->flash('success', $message);
    }

    public function render()
    {
        return view('livewire.annuaire.agent-form');
    }
}
