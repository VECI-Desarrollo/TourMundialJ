<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
class NavigationBar extends Component
{
    public $activeTab = 'RegistroPagos';

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function updated($activeTab)
    {
        $this->activeTab = $activeTab;
    }

    public function mount()
    {
        $this->activeTab = 'RegistroPagos'; // Resetear el valor de $activeTab
    }

    public function render()
    {
        return view('livewire.navigation-bar');
    }
}
