<?php

namespace App\Livewire\Admin;

use App\Models\Entity;
use Livewire\Component;

class EntityHierarchyManager extends Component
{
    public $showForm = false;
    public $editingEntity = null;
    public $form = [
        'nom' => '',
        'type' => 'direction',
        'parent_id' => '',
        'is_active' => true,
    ];

    protected $rules = [
        'form.nom' => 'required|string|max:100',
        'form.type' => 'required|in:direction,service,departement',
        'form.parent_id' => 'nullable|exists:entities,id',
        'form.is_active' => 'boolean',
    ];

    protected $messages = [
        'form.nom.required' => 'Le nom est obligatoire.',
        'form.nom.max' => 'Le nom ne peut pas dépasser 100 caractères.',
        'form.type.required' => 'Le type est obligatoire.',
        'form.type.in' => 'Type invalide.',
        'form.parent_id.exists' => 'L\'entité parente n\'existe pas.',
    ];

    public function closeForm()
    {
        $this->showForm = false;
        $this->editingEntity = null;
        $this->form = ['nom' => '', 'type' => 'direction', 'parent_id' => '', 'is_active' => true];
        $this->resetValidation();
    }

    public function createEntity()
    {
        $this->resetForm();
        $this->showForm = true;
        $this->editingEntity = null;
    }

    public function editEntity(Entity $entity)
    {
        $this->editingEntity = $entity;
        $this->form = [
            'nom' => $entity->nom,
            'type' => $entity->type,
            'parent_id' => $entity->parent_id,
            'is_active' => $entity->is_active,
        ];
        $this->showForm = true;
    }

    public function saveEntity()
    {
        $this->validate();

        // Validation métier : une direction ne peut pas avoir de parent
        if ($this->form['type'] === 'direction' && $this->form['parent_id']) {
            $this->addError('form.parent_id', 'Une direction ne peut pas avoir de parent.');
            return;
        }

        // Validation métier : un service doit avoir une direction comme parent
        if ($this->form['type'] === 'service' && !$this->form['parent_id']) {
            $this->addError('form.parent_id', 'Un service doit avoir une direction comme parent.');
            return;
        }

        // Validation métier : un département doit avoir un service comme parent
        if ($this->form['type'] === 'departement') {
            if (!$this->form['parent_id']) {
                $this->addError('form.parent_id', 'Un département doit avoir un service comme parent.');
                return;
            }

            $parent = Entity::find($this->form['parent_id']);
            if ($parent && $parent->type !== 'service') {
                $this->addError('form.parent_id', 'Un département doit avoir un service comme parent.');
                return;
            }
        }

        if ($this->editingEntity) {
            $this->editingEntity->update($this->form);
            session()->flash('message', 'Entité modifiée avec succès.');
        } else {
            Entity::create($this->form);
            session()->flash('message', 'Entité créée avec succès.');
        }

        $this->showForm = false;
        $this->resetForm();
    }

    public function deleteEntity(Entity $entity)
    {
        // Vérifier si l'entité a des enfants
        if ($entity->children()->count() > 0) {
            session()->flash('error', 'Impossible de supprimer cette entité car elle contient des sous-entités.');
            return;
        }

        // Vérifier si l'entité a des agents
        if ($entity->agents()->count() > 0) {
            session()->flash('error', 'Impossible de supprimer cette entité car elle contient des agents.');
            return;
        }

        $entity->delete();
        session()->flash('message', 'Entité supprimée avec succès.');
    }

    public function toggleActive(Entity $entity)
    {
        $entity->update(['is_active' => !$entity->is_active]);
        session()->flash('message', 'Statut de l\'entité mis à jour.');
    }

    private function resetForm()
    {
        $this->form = [
            'nom' => '',
            'type' => 'direction',
            'parent_id' => '',
            'is_active' => true,
        ];
        $this->resetValidation();
    }

    public function render()
    {
        // Récupérer toutes les entités organisées hiérarchiquement
        $directions = Entity::where('type', 'direction')
            ->with(['children' => function($q) {
                $q->with(['children'])->orderBy('nom');
            }])
            ->orderBy('nom')
            ->get();

        // Liste des entités pour les parents
        $availableParents = Entity::where('is_active', true)
            ->whereIn('type', ['direction', 'service'])
            ->orderBy('nom')
            ->get();

        return view('livewire.admin.entity-hierarchy-manager', [
            'directions' => $directions,
            'availableParents' => $availableParents,
        ]);
    }
}
