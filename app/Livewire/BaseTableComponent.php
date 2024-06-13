<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class BaseTableComponent extends Component
{
    use WithPagination;
    public $search;
    public $paginate;
    public $sortBy;
    public $sortDirection;
    public $dataCount;

    public function mount(){
        $this->sortBy = 'table_column_name';
        $this->sortDirection = 'desc'; // desc or asc
        $this->paginate = 10; // number of rows in pagination
        // $this->dataCount = SomeModel::all()->count(); //query depending on what data you are fetching
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

    public function fetchDataName(){
        //query depending on what data you are fetching you can use $this->search if the query have searching;
        // $data = SomeModel::where(function($query){
        //     $query->where('table_column_name', 'like', '%'.$this->search.'%');
        // })
        // ->orderBy($this->sortBy, $this->sortDirection)
        // ->paginate($this->paginate, pageName: 'page-name'); // only use pageName when you have multiple livewire component in one page

        // return $data;
    }

    public function render()
    {
        return view('livewire.base-table-component');
    }
}
