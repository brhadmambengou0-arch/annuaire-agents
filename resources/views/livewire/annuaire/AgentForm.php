<?php

namespace App\Livewire\Annuaire;

use Livewire\Component;
use App\Models\Agent;
use App\Models\Entity;
use App\Models\Fonction;
use Illuminate\Support\Str;

class AgentForm extends Component
{
    public $agentId = null;
    public $form = [
        'matricule' => '',
        'nom' => '',
        'prenom' => '',
        'email' => '',
        'telephone' => '',
        'telephone_pro' => '',
        'entity_id' => '',
        'fonction_id' => '',
        'is_active' => true,
    ];

    protected $rules = [
        'form.matricule' => 'required|string|max:50|unique:agents,matricule',
        'form.nom' => 'required|string|max:100',
        'form.prenom' => 'required|string|max:100',
        'form.email' => 'required|email|max:255|unique:agents,email',
        'form.telephone' => 'nullable|string|max:20',
        'form.telephone_pro' => 'nullable|string|max:20',
        'form.entity_id' => 'required|exists:entities,uuid',
        'form.fonction_id' => 'required|exists:fonctions,id',
        'form.is_active' => 'boolean',
    ];

    protected $listeners = [
        'open-create' => 'openCreate',
        'open-edit' => 'openEdit',
    ];

    public function openCreate()
    {
        $this->resetForm();
        $this->agentId = null;
        $this->dispatch('show-modal');
    }

    public function openEdit($agentId)
    {
        $agent = Agent::where('uuid', $agentId)->firstOrFail();
        $this->agentId = $agentId;
        $this->form = [
            'matricule' => $agent->matricule,
            'nom' => $agent->nom,
            'prenom' => $agent->prenom,
            'email' => $agent->email,
            'telephone' => $agent->telephone,
            'telephone_pro' => $agent->telephone_pro,
            'entity_id' => $agent->entity_id,
            'fonction_id' => $agent->fonction_id,
            'is_active' => $agent->is_active,
        ];
        $this->dispatch('show-modal');
    }

    public function save()
    {
        $this->validate();

        if ($this->agentId) {
            $agent = Agent::where('uuid', $this->agentId)->firstOrFail();
            $agent->update($this->form);
            $message = 'Agent mis à jour avec succès.';
        } else {
            $this->form['uuid'] = (string) Str::uuid();
            Agent::create($this->form);
            $message = 'Agent créé avec succès.';
        }

        $this->resetForm();
        $this->dispatch('hide-modal');
        $this->dispatch('refreshDirectory')->to(\App\Livewire\Annuaire\DirectoryIndex::class);
        session()->flash('success', $message);
    }

    public function resetForm()
    {
        $this->reset('form');
        $this->form['is_active'] = true;
    }

    public function render()
    {
        return view('livewire.annuaire.agent-form', [
            'entities' => Entity::where('is_active', true)->orderBy('ordre')->get(),
            'fonctions' => Fonction::where('is_active', true)->orderBy('libelle')->get(),
        ]);
    }
}