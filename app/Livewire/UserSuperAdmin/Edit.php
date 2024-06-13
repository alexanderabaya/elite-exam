<?php

namespace App\Livewire\UserSuperAdmin;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Spatie\Permission\Models\Role;
class Edit extends Component
{
    use WithFileUploads;
    public $name;
    public $username;
    public $email;
    public $password;
    public $confirmPassword;
    public $avatar;
    public $imageData;
    public $role;
    public $roles;
    public $company;
    public $user;

    public function mount(){
        $this->roles = Role::where('id', '!=', 1)->get();
        $this->name = $this->user->name;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->company = $this->user->company_id;
        $this->role = $this->user->roles->first()->id;
    }

    public function uploadImage(){
        $this->dispatch('upload-image');
    }

    public function resetCropper(){
        $this->dispatch('reset-cropper');
    }

    public function cropPhoto(){
        $this->dispatch('crop-photo');
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|regex:/^[a-zA-Z-zÁáÉéÍíÓóÚúñ. ]+$/u|max:255',
            'username' => 'required|max:50|unique:users,username,'.$this->user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$this->user->id,
            'role' => 'required|numeric',
            'company' => 'required|numeric',
        ]);


        $user = User::where('id', $this->user->id)
        ->update([
            'company_id' => $this->company,
            'email' => $this->email,
            'username' => $this->username,
            'name' => $this->name,
        ]);

        $role = Role::findById($this->role);
        $this->user->syncRoles([$role->name]);

        redirect()->route('redirectAlert.index', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'User Updated',
            'buttonText' => 'Confirm',
            'route' => 'superadmin.user.index',
            'parameters' => null,
        ]);
    }

    public function render()
    {
        return view('livewire.user-super-admin.edit');
    }
}
