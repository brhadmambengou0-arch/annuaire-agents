<?php

namespace App\Livewire\Admin;

use App\Models\Fonction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class FonctionManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    // ── Propriétés du formulaire ──────────────────────────
    public bool $showModal  = false;
    public ?int $fonctionId = null;

    #[Validate('required|string|max:50')]
    public string $code = '';

    #[Validate('required|string|max:150')]
    public string $libelle = '';

    #[Validate('required|integer|min:1|max:6')]
    public int $niveau = 1;

    #[Validate('nullable|string')]
    public string $description = '';

    public function getEditIdProperty()
    {
        return $this->fonctionId;
    }

    public function getFonctionsProperty()
    {
        return Fonction::orderBy('libelle')->paginate(12);
    }

    // ── Actions ───────────────────────────────────────────

    public function openCreate(): void
    {
        $this->reset(['fonctionId', 'code', 'libelle', 'niveau', 'description']);
        $this->showModal = true;
    }

    public function openEdit(int $id): void
    {
        $fonction = Fonction::findOrFail($id);
        $this->fonctionId  = $fonction->id;
        $this->code        = $fonction->code;
        $this->libelle     = $fonction->libelle;
        $this->niveau      = $fonction->niveau;
        $this->description = $fonction->description ?? '';
        $this->showModal   = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'libelle'     => $this->libelle,
            'niveau'      => $this->niveau,
            'description' => $this->description,
            'is_active'   => true,
        ];

        if ($this->fonctionId) {
            // Modification — le code est immuable
            Fonction::findOrFail($this->fonctionId)->update($data);
            session()->flash('success', 'Fonction modifiée avec succès.');
        } else {
            // Création — le code est requis et unique
            $data['code'] = strtoupper($this->code);
            Fonction::create($data);
            session()->flash('success', 'Fonction créée avec succès.');
        }

        $this->showModal = false;
        $this->reset(['fonctionId', 'code', 'libelle', 'niveau', 'description']);
    }

    public function deactivate(int $id): void
    {
        $fonction = Fonction::findOrFail($id);

        // Vérifie qu'aucun agent actif n'utilise cette fonction
        if ($fonction->hasActiveAgents()) {
            session()->flash('error',
                'Impossible : des agents actifs utilisent cette fonction.');
            return;
        }

        $fonction->update(['is_active' => false]);
        session()->flash('success', 'Fonction désactivée.');
    }

    public function closeForm(): void
    {
        $this->showModal = false;
        $this->reset(['fonctionId', 'code', 'libelle', 'niveau', 'description']);
    }

    public function render()
    {
        return view('livewire.admin.fonction-manager', [
            'fonctions' => Fonction::orderBy('libelle')->get(),
        ]);
    }
}
