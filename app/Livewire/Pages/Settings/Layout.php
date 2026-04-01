<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Component;

class Layout extends Component
{
    public string $heading = '';
    public string $subheading = '';

    public function mount(string $heading = '', string $subheading = '')
    {
        $this->heading = $heading;
        $this->subheading = $subheading;
    }

    public function render()
    {
        return view('pages.settings.layout');
    }
}