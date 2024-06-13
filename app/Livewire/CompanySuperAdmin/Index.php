<?php

namespace App\Livewire\CompanySuperAdmin;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $paginate;
    public $sortBy;
    public $sortDirection;
    public $companyCount;

    public function mount(){
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->paginate = 10;
        $this->companyCount = Company::all()->count();
    }

    public function swapSortDirection(){
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function sortTable($columnName){
        if($this->sortBy === $columnName){
            $this->sortDirection = $this->swapSortDirection();
        }
        else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $columnName;
    }

    public function updatedPaginate(){
        $this->resetPage();
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function fetchCompany(){

        $companies = Company::withCount('user')
        ->where(function($q){
            $q->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhere('address', 'like', '%'.$this->search.'%')
            ->orWhere('created_at', 'like', '%'.$this->search.'%')
            ->orWhereHas('user', function ($query) {
                $query->select('company_id')
                ->groupBy('company_id')
                ->havingRaw('CAST(COUNT(*) AS CHAR) LIKE ?', [$this->search]);
            });
        })
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->paginate);
        return $companies;
    }

    public function render()
    {
        return view('livewire.company-super-admin.index', [
            'companies' => $this->fetchCompany(),
        ]);
    }
}
