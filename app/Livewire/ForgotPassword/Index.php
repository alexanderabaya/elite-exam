<?php

namespace App\Livewire\ForgotPassword;

use App\Mail\ResetPasswordMail;
use App\Models\ForgotPassword;
use App\Models\User;
use App\Rules\ExistingAccountRule;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $email;
    public $confirmation;

    public function submitForm(){
        $this->confirmation = 0;

        $this->validate([
            'email' => ['required', 'max:255', new ExistingAccountRule()]
        ],[
            'email.required' => "The email or username field is required.",
            'email.max' => "The email or username field must not be greater than 2 characters."
        ]);

        $user = User::where('username', $this->email)->orWhere('email', $this->email)->first();

        $forgotPassword = ForgotPassword::where('user_id', $user->id)
        ->whereBetween('created_at', [now()->subMinutes(30), now()])
        ->get();

        if($forgotPassword->count()){
            $this->addError('manyTries', "We've already sent a mail in your account's email address, you can try again after 30 minutes.");
        }
        else{
            ForgotPassword::where('user_id', $user->id)->delete();
            $generatedLink = ForgotPassword::create([
                'user_id' => $user->id,
                'token' => Str::random(60)
            ]);

            $data = [
                'uuid' => $generatedLink->uuid,
                'token' => $generatedLink->token,
            ];

            Mail::to($user->email)->send(new ResetPasswordMail($data));

            $this->confirmation = 1;
        }
    }

    public function render()
    {
        return view('livewire.forgot-password.index');
    }
}
