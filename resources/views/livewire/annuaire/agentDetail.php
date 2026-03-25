<?php

namespace App\Livewire\Annuaire;

use App\Models\Agent;
use Livewire\Attributes\On;
use Livewire\Component;

class AgentDetail extends Component
{
    public bool $show = false;
    public ?Agent $agent = null;

    protected array $avatarPalette = [
        ['bg' => '#dbeafe', 'color' => '#1e40af'],
        ['bg' => '#dcfce7', 'color' => '#166534'],
        ['bg' => '#fef9c3', 'color' => '#854d0e'],
        ['bg' => '#fce7f3', 'color' => '#9d174d'],
        ['bg' => '#ede9fe', 'color' => '#5b21b6'],
        ['bg' => '#ffedd5', 'color' => '#9a3412'],
        ['bg' => '#e0f2fe', 'color' => '#075985'],
        ['bg' => '#f0fdf4', 'color' => '#14532d'],
    ];

    #[On('open-agent-detail')]
    public function open(int $agentId): void
    {
        $this->agent = Agent::with(['entity.parent.parent', 'fonction'])->findOrFail($agentId);
        $this->show = true;
    }

    public function close(): void
    {
        $this->show = false;
        $this->agent = null;
    }

    public function getAvatarBgProperty(): string
    {
        if (!$this->agent) return '#dbeafe';
        $index = ord(strtoupper($this->agent->nom[0])) % count($this->avatarPalette);
        return $this->avatarPalette[$index]['bg'];
    }

    public function getAvatarColorProperty(): string
    {
        if (!$this->agent) return '#1e40af';
        $index = ord(strtoupper($this->agent->nom[0])) % count($this->avatarPalette);
        return $this->avatarPalette[$index]['color'];
    }

    public function modifier(): void
    {
        $this->close();
        $this->dispatch('open-agent-form', agentId: $this->agent?->id);
    }

    public function desactiver(): void
    {
        $this->agent?->update(['is_active' => false]);
        $this->close();
        $this->dispatch('agent-deleted');
        session()->flash('success', 'Agent désactivé avec succès.');
    }

    public function reactiver(): void
    {
        $this->agent?->update(['is_active' => true]);
        $this->close();
        $this->dispatch('agent-saved');
        session()->flash('success', 'Agent réactivé avec succès.');
    }

    public function render()
    {
        return view('livewire.annuaire.agent-detail');
    }
}
