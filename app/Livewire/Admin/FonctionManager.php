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
    public bool $showModal  = false;
    public ?string $fonctionId = null;
    public string $search = '';
    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedFilterNiveau(): void { $this->resetPage(); }
    public function updatedFilterActif(): void { $this->resetPage(); }
    public string $filterNiveau = '';
    public string $filterActif = '';
    #[Validate('required|string|max:50')]
    public string $code = '';
    #[Validate('required|string|max:150')]
    public string $libelle = '';
    #[Validate('required|integer|min:1|max:6')]
    public int $niveau = 1;
    #[Validate('nullable|string')]
    public string $description = '';
    public function openCreate(): void
    {
        $this->reset(['fonctionId', 'code', 'libelle', 'niveau', 'description']);
        $this->niveau = 1;
        $this->showModal = true;
    }
    public function openEdit(string $id): void
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
        ];
        if ($this->fonctionId) {
            Fonction::findOrFail($this->fonctionId)->update($data);
            session()->flash('success', 'Fonction modifiée avec succès.');
        } else {
            $data['code'] = strtoupper($this->code);
            $data['is_active'] = true;
            Fonction::create($data);
            session()->flash('success', 'Fonction créée avec succès.');
        }
        $this->showModal = false;
        $this->reset(['fonctionId', 'code', 'libelle', 'niveau', 'description']);
        $this->niveau = 1;
    }
    public function toggleActive(string $id): void
    {
        $fonction = Fonction::findOrFail($id);
        $fonction->update(['is_active' => !$fonction->is_active]);
        session()->flash('success', 'Statut mis à jour.');
    }
    public function closeForm(): void
    {
        $this->showModal = false;
        $this->reset(['fonctionId', 'code', 'libelle', 'niveau', 'description']);
        $this->niveau = 1;
    }
    public function render()
    {
        $fonctions = Fonction::query()
            ->when($this->search, fn($q) =>
                $q->whereRaw('LOWER(libelle) LIKE ?', ['%' . strtolower($this->search) . '%'])
            )
            ->when($this->filterNiveau, fn($q) =>
                $q->where('niveau', (int) $this->filterNiveau)
            )
            ->when($this->filterActif !== '' && $this->filterActif !== null, fn($q) =>
                $q->where('is_active', $this->filterActif === '1')
            )
            ->orderBy('niveau')
            ->orderBy('libelle')
            ->get();
        return view('livewire.admin.fonction-manager', compact('fonctions'));
    }
}
