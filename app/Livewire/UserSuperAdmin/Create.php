<?php

namespace App\Livewire\UserSuperAdmin;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Spatie\Permission\Models\Role;

class Create extends Component
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

    public function mount(){
        $this->roles = Role::where('id', '!=', 1)->get();
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

    public function storeUser()
    {
        $this->validate([
            'name' => 'required|regex:/^[a-zA-Z-zÁáÉéÍíÓóÚúñ. ]+$/u|max:255',
            'username' => 'required|max:50|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|numeric',
            'company' => 'required|numeric',
            'password' => 'required|max:100',
            'confirmPassword' => 'required|max:100|same:password',
        ]);


        $user = User::create([
            'company_id' => $this->company,
            'email' => $this->email,
            'username' => $this->username,
            'name' => $this->name,
            'password' => bcrypt($this->password),
        ]);

        $role = Role::findById($this->role);
        $user->assignRole($role);

        redirect()->route('redirectAlert.index', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'User Added',
            'buttonText' => 'Confirm',
            'route' => 'superadmin.user.index',
            'parameters' => null,
        ]);
    }
    public function render()
    {
        return view('livewire.user-super-admin.create');
    }
}
