<?php

namespace App\Livewire\Inputs;

use App\Models\Company;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;

class CompanySelection extends Component
{
    #[Modelable]
    public $value;

    public $search;
    public $dropdownVisibility;
    public $selectionArray;
    public $searchedArray;

    public function mount(){
        $this->refreshSelection();
        $this->selectValue($this->value);
        $this->updatedSearch($this->search);
    }

    public function hydrate(){
        if($this->value == null){
            $this->search = null;
        }
    }

    public function selectValue($id){
        $company = Company::where('id', $id)->first();
        if($company){
            $this->value = $company->id;
            $this->search = $company->name;
        }
    }

    #[On('widget-store-company')]
    public function selectAddedCompany($id){
        $this->refreshSelection();
        $company = Company::where('id', $id)->first();
        if($company){
            $this->value = $company->id;
            $this->search = $company->name;
            $this->updatedSearch($company->name);
        }
    }

    #[On('widget-manual-select-company')]
    public function manualSelectCompany($id){
        $this->refreshSelection();
        $company = Company::where('id', $id)->first();
        if($company){
            $this->value = $company->id;
            $this->search = $company->name;
            $this->updatedSearch($company->name);
        }
    }

    public function onBlur(){

        if($this->value == null){
            $this->search = null;
            $this->updatedSearch(null);
        }
        $this->dropdownVisibility = 0;
    }


    public function refreshSelection(){
        $companies = Company::where(function($query){
            if(auth()->user()->roles->first()->id == 2){
                $query->where('user_id', auth()->user()->id );
            }
        })
        ->orderBy('name', 'asc')
        ->get();

        $this->selectionArray = $companies->map(function ($company) {
            return [
                'value' => $company->id,
                'name' => $company->name
            ];
        });
        $this->searchedArray = $this->selectionArray;
    }

    public function updatedSearch($value){
        $this->searchedArray = $value ? $this->selectionArray->filter(function ($company) use ($value) {
            return stripos($company['name'], $value) !== false;
        })
        : $this->selectionArray;
    }

    public function render()
    {
        return view('livewire.inputs.company-selection');
    }
}
