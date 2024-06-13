<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Rules\CorrectPasswordRule;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $user;
    public $name;
    public $username;
    public $email;
    public $image;
    public $imageData;
    public $newPassword;
    public $currentPassword;
    public $confirmPassword;



    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->username= $this->user->username;
        $this->email = $this->user->email;

    }

    protected function rules()
    {
        return [
            'name' => 'required|string|regex:/^[a-zA-Z-zÁáÉéÍíÓóÚúñ. ]+$/u|max:255',
            'username' => 'required|max:50|unique:users,username,'.$this->user->id,
            'email' => 'required|max:255|unique:users,email,'.$this->user->id,
            'currentPassword' => ['required', new CorrectPasswordRule()],
            'newPassword' => ['required', 'max:50'],
            'confirmPassword' => 'required|in:'.$this->newPassword,
        ];
    }

    protected function messages()
    {
        return [
            'confirmPassword.in' => 'The new password does not match',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function uploadImage(){
        $this->dispatch('uploadImage');
    }


    public function resetCropper(){
        $this->dispatch('resetCropper');
    }

    public function getUser(){
        $this->user = auth()->user();
    }

    public function cropPhoto(){
        $this->dispatch('cropPhoto');
    }

    public function updateAvatar(){
        if($this->image){
            $image_parts = explode(";base64,", $this->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $folderPath = public_path('database-image/profile-image/');
            $imagePhoto = time() . '.png';
            $imageFullPath = $folderPath.$imagePhoto;
            file_put_contents($imageFullPath, $image_base64);
            if(auth()->user()->profile_photo_path){
                if (file_exists(public_path('database-image/profile-image/'.auth()->user()->profile_photo_path))) {
                    unlink("database-image/profile-image/".auth()->user()->profile_photo_path);
                }
            }
        }
        User::where('id', auth()->user()->id)
        ->update([
            'profile_photo_path' => $imagePhoto
        ]);

        alert()->success('Success', 'Avatar Saved Successfully.')->showConfirmButton('Okay', '#f55247');
        redirect()->route('profile.index');
    }

    public function updateProfile(){

        $validatedData = $this->validate([
            'name' => 'required|string|regex:/^[a-zA-Z-zÁáÉéÍíÓóÚúñ. ]+$/u|max:255',
            'username' => 'required|max:50|unique:users,username,'.$this->user->id,
            'email' => 'required|max:255|unique:users,email,'.$this->user->id,
        ]);

        User::where('id', auth()->user()->id)
        ->update([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email
        ]);

        alert()->success('Success', 'Profile Information Saved Successfully.')->showConfirmButton('Okay', '#f55247');
        redirect()->route('profile.index');
    }

    public function updatePassword(){

        $validatedData = $this->validate([
            'currentPassword' => ['required', new CorrectPasswordRule()],
            'newPassword' => ['required', 'max:50'],
            'confirmPassword' => 'required|in:'.$this->newPassword,
        ]);

        User::where('id', auth()->user()->id)
        ->update([
            'password' => bcrypt($this->newPassword),
        ]);

        alert()->success('Success', 'Password Saved Successfully.')->showConfirmButton('Okay', '#f55247');
        redirect()->route('profile.index');
    }

    public function resetProfile(){
        $this->image = "";
        $this->newPassword = "";
        $this->currentPassword = "";
        $this->confirmPassword = "";
    }

    public function render()
    {
        return view('livewire.profile.index');
    }
}
