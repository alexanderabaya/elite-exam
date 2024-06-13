<?php

namespace App\Livewire\ForgotPassword;

use App\Models\ForgotPassword;
use App\Models\User;
use Livewire\Component;

class Reset extends Component
{
    public $forgotPassword;
    public $newPassword;
    public $confirmPassword;

    public function submitForm(){
        $this->validate([
            'newPassword' => 'required|max:100',
            'confirmPassword' => 'required|max:100|same:newPassword',
        ]);

        User::where('id', $this->forgotPassword->user_id)
        ->update([
            'password' => bcrypt($this->newPassword)
        ]);

        ForgotPassword::where('id', $this->forgotPassword->id)->delete();

        alert()->success('Success', 'Password Reset Successfully.')->showConfirmButton('Okay', '#f55247');
        redirect('/');
    }

    public function render()
    {
        return view('livewire.forgot-password.reset');
    }
}
