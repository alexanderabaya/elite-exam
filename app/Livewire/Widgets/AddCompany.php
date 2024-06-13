<?php

namespace App\Livewire\Widgets;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCompany extends Component
{
    use WithFileUploads;
    public $companyName;
    public $companyEmail;
    public $companyImage;
    public $companyAddress;
    public $imageData;

    public function uploadImage(){
        $this->dispatch('widget-company-upload-image');
    }

    public function resetCropper(){
        $this->dispatch('widget-company-reset-cropper');
    }

    public function cropPhoto(){
        $this->dispatch('widget-company-crop-image');
    }

    public function removeImage(){
        $this->imageData = null;
        $this->companyImage = null;
    }

    public function storeCompany()
    {
        $this->validate([
            'companyName' => 'required|max:255|unique:company,name',
            'companyEmail' => 'required|email|max:255|unique:company,email',
            'companyAddress' => 'required|max:255',
        ]);

        $imagePhoto = null;
        if($this->companyImage){
            $image_parts = explode(";base64,", $this->companyImage);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $folderPath = public_path('database-image/company-image/');
            $imagePhoto = time() . '.png';
            $imageFullPath = $folderPath.$imagePhoto;
            file_put_contents($imageFullPath, $image_base64);
        }

        $company = Company::create([
            'name' => $this->companyName,
            'email' => $this->companyEmail,
            'address' => $this->companyAddress,
            'image' => $imagePhoto,
        ]);

        $this->dispatch('widget-store-company', id : $company->id);
    }

    public function resetInputs(){
        $this->companyName = null;
        $this->companyEmail = null;
        $this->companyImage = null;
        $this->companyAddress = null;
        $this->imageData = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.widgets.add-company');
    }
}
