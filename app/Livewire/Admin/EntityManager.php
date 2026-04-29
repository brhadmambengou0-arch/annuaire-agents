<?php

namespace App\Livewire\Admin;

use App\Models\Entity;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class EntityManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // ── Propriétés du formulaire ──────────────────────────
    public bool $showModal = false;
    public ?int $entityId  = null;

    #[Validate('required|string|max:150')]
    public string $nom = '';

    #[Validate('required|string|max:30')]
    public string $code = '';

    #[Validate('required|in:direction,service,departement')]
    public string $type = 'direction';

    #[Validate('nullable|exists:entities,id')]
    public ?int $parentId = null;

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|integer')]
    public int $ordre = 0;

    // ── Computed Properties ───────────────────────────────

    public function getEntitiesProperty()
    {
        return Entity::with('parent')
                     ->orderBy('ordre')
                     ->paginate(12);
    }
    #[Computed]
    public function getParentsProperty()
    {
        return Entity::where('is_active', true)
                     ->whereIn('type', ['direction', 'service'])
                     ->orderBy('nom')
                     ->get();
    }

    public function getEditIdProperty()
    {
        return $this->entityId;
    }

    // ── Actions ───────────────────────────────────────────

    public function openCreate(): void
    {
        $this->reset(['entityId', 'nom', 'code', 'type',
                      'parentId', 'description', 'ordre']);
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $entity = Entity::findOrFail($id);
        $this->entityId    = $entity->id;
        $this->nom         = $entity->nom;
        $this->code        = $entity->code;
        $this->type        = $entity->type;
        $this->parentId    = $entity->parent_id;
        $this->description = $entity->description ?? '';
        $this->ordre       = $entity->ordre;
        $this->showModal   = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'nom'         => $this->nom,
            'code'        => strtoupper($this->code),
            'type'        => $this->type,
            'parent_id'   => $this->parentId,
            'description' => $this->description,
            'ordre'       => $this->ordre,
            'is_active'   => true,
        ];

        if ($this->entityId) {
            Entity::findOrFail($this->entityId)->update($data);
            session()->flash('success', 'Entité modifiée avec succès.');
        } else {
            Entity::create($data);
            session()->flash('success', 'Entité créée avec succès.');
        }

        $this->showModal = false;
        $this->reset(['entityId', 'nom', 'code', 'type',
                      'parentId', 'description', 'ordre']);
    }

    public function toggleActive(int $id): void
    {
        $entity = Entity::findOrFail($id);

        if ($entity->agents()->where('is_active', true)->exists() && $entity->is_active) {
            session()->flash('error',
                'Impossible : des agents actifs sont rattachés à cette entité.');
            return;
        }

        $entity->update(['is_active' => ! $entity->is_active]);
        session()->flash('success', $entity->is_active ? 'Entité réactivée.' : 'Entité désactivée.');
    }

    public function closeForm(): void
    {
        $this->showModal = false;
        $this->reset(['entityId', 'nom', 'code', 'type',
                      'parentId', 'description', 'ordre']);
    }

    public function render()
    {
        return view('livewire.admin.entity_manager', [
            'entities' => $this->getEntitiesProperty(),
            // 'parents'  => $this->getParentsProperty(),
        ]);
    }
}