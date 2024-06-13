<?php

namespace App\Livewire;

use Livewire\Component;

class BaseComponent extends Component
{
    public $variable;

    public function mount(){

    }

    protected function rules()
    {
        return [
            // 'variable' => 'required|max:200|unique:chapter,name',
        ];
    }

    protected function messages()
    {
        return [

        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function withDispatch(){
        $this->dispatch('dispatch-something');
    }

    public function withValidation(){
        $this->validate([
            // 'variable' => 'required|max:200|unique:chapter,name',
        ]);
    }

    public function withRedirect(){
        alert()->success('Success', 'Go to Dashboard.')->showConfirmButton('Confirm', '#333333');
        redirect()->route('dashboard.index');
    }

    public function resetInput(){
        $this->variable = null;

        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.base-component');
    }
}
