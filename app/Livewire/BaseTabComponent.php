<?php

namespace App\Livewire;

use Livewire\Component;

class BaseTabComponent extends Component
{
    public $currentTab;

    public function mount(){
        $this->currentTab = 1;
    }

    public function changeTab($tab){
        $this->currentTab = $tab;
    }

    public function render()
    {
        return view('livewire.base-tab-component');
    }
}
