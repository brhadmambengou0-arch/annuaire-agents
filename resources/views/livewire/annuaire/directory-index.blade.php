{{-- GRILLE AGENTS --}}
<div wire:loading.class="opacity-50" style="transition:opacity .2s;">
    
    @if($agents->count())
        <div class="grid" style="grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;">
            @foreach($agents as $agent)
                @livewire('annuaire.agent-card', ['agent' => $agent], key($agent->uuid))
            @endforeach
        </div>

        <div class="pagination-wrap" style="margin-top:1rem;">
            {{ $agents->links() }}
        </div>

    @else
        <div class="empty-state">
            <h5>Aucun agent trouvé</h5>
            <button wire:click="resetFilters" class="btn-primary">
                Réinitialiser
            </button>
        </div>
    @endif

</div>