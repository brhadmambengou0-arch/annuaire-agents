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
         'code' => '',
        'parent_id' => '',
        'is_active' => true,
    ];

    protected $rules = [
        'form.nom' => 'required|string|max:100',
              'form.code' => 'required|string|max:100|unique:entities,code',
        'form.type' => 'required|in:direction,service,departement',
        'form.parent_id' => 'nullable|exists:entities,id',
        'form.is_active' => 'boolean',
    ];

    protected $messages = [
        'form.nom.required' => 'Le nom est obligatoire.',
        'form.nom.max' => 'Le nom ne peut pas dépasser 100 caractères.',
        'form.code.required' => 'Le code est obligatoire.',
        'form.code.max' => 'Le code ne peut pas dépasser 100 caractères.',
        'form.code.exists' => 'Le code existe déjà.',
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
            'code' => $entity->code,
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
            $data=$this->form;$data['parent_id']=$data['parent_id']?:null;$this->editingEntity->update($data);
            session()->flash('message', 'Entité modifiée avec succès.');
        } else {
$data=$this->form;$data['parent_id']=$data['parent_id']?:null;Entity::create($data);
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

    public function updatedFormType():void{$this->form['parent_id']='';}public function getParentOptionsProperty(){return match($this->form['type']??''){ 'service'=>\App\Models\Entity::where('type','direction')->where('is_active',true)->orderBy('nom')->get(),'departement'=>\App\Models\Entity::where('type','service')->where('is_active',true)->orderBy('nom')->get(),default=>collect(),};}private function resetForm()
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
