/\s*<div class="form-group" wire:ignore>/,/\s*<\/div>/{
    /\s*<div class="form-group" wire:ignore>/i\                            {{-- ENTITÉ PARENTE : filtre dynamique selon le type --}}
    /\s*<div class="form-group" wire:ignore>/i\                            <div class="form-group">
    /\s*<div class="form-group" wire:ignore>/i\                                <label class="form-label">
    /\s*<div class="form-group" wire:ignore>/i\                                    Entité parente
    /\s*<div class="form-group" wire:ignore>/i\                                    @if($form['type'] === 'direction')
    /\s*<div class="form-group" wire:ignore>/i\                                        <small style="color:#64748b;font-weight:400;">(non applicable pour les directions)</small>
    /\s*<div class="form-group" wire:ignore>/i\                                    @elseif($form['type'] === 'service')
    /\s*<div class="form-group" wire:ignore>/i\                                        <small style="color:#64748b;font-weight:400;">(doit être une direction)</small>
    /\s*<div class="form-group" wire:ignore>/i\                                    @else
    /\s*<div class="form-group" wire:ignore>/i\                                        <small style="color:#64748b;font-weight:400;">(doit être un service)</small>
    /\s*<div class="form-group" wire:ignore>/i\                                    @endif
    /\s*<div class="form-group" wire:ignore>/i\                                </label>
    /\s*<div class="form-group" wire:ignore>/i\                                @if($form['type'] === 'direction')
    /\s*<div class="form-group" wire:ignore>/i\                                    <select class="form-select" disabled>
    /\s*<div class="form-group" wire:ignore>/i\                                        <option>Aucune (direction racine)</option>
    /\s*<div class="form-group" wire:ignore>/i\                                    </select>
    /\s*<div class="form-group" wire:ignore>/i\                                @else
    /\s*<div class="form-group" wire:ignore>/i\                                    <select wire:model.live="form.parent_id" class="form-select">
    /\s*<div class="form-group" wire:ignore>/i\                                        <option value="">
    /\s*<div class="form-group" wire:ignore>/i\                                            {{ $form['type'] === 'service' ? 'Sélectionner une direction' : 'Sélectionner un service' }}
    /\s*<div class="form-group" wire:ignore>/i\                                        </option>
    /\s*<div class="form-group" wire:ignore>/i\                                        @foreach($this->parentOptions as $parent)
    /\s*<div class="form-group" wire:ignore>/i\                                            <option value="{{ $parent->id }}">{{ $parent->nom }}</option>
    /\s*<div class="form-group" wire:ignore>/i\                                        @endforeach
    /\s*<div class="form-group" wire:ignore>/i\                                    </select>
    /\s*<div class="form-group" wire:ignore>/i\                                    @error('form.parent_id') <span style="color:#ef4444;font-size:0.75rem;margin-top:0.25rem;display:block;">{{ $message }}</span> @enderror
    /\s*<div class="form-group" wire:ignore>/i\                                @endif
    /\s*<div class="form-group" wire:ignore>/i\                            </div>
    d
}
