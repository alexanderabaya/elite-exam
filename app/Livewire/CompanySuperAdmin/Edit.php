<?php

namespace App\Livewire\CompanySuperAdmin;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $company;
    public $companyName;
    public $companyEmail;
    public $companyImage;
    public $companyAddress;
    public $imageData;

    public function mount(){
        $this->companyName = $this->company->name;
        $this->companyEmail = $this->company->email;
        $this->companyAddress = $this->company->address;
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

    public function removeImage(){
        $this->imageData = null;
        $this->companyImage = null;
    }

    public function storeCompany()
    {
        $this->validate([
            'companyName' => 'required|max:255|unique:company,name,'.$this->company->id,
            'companyEmail' => 'required|email|max:255|unique:company,email,'.$this->company->id,
            'companyAddress' => 'required|max:255',
        ]);

        $imagePhoto = $this->company->image;
        if($this->companyImage){
            $image_parts = explode(";base64,", $this->companyImage);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $folderPath = public_path('database-image/company-image/');
            $imagePhoto = time() . '.png';
            $imageFullPath = $folderPath.$imagePhoto;
            file_put_contents($imageFullPath, $image_base64);
            if($this->company->image){
                if (file_exists(public_path('database-image/company-image/'.$this->company->image))) {
                    unlink("database-image/company-image/".$this->company->image);
                }
            }
        }

        $company = Company::where('id', $this->company->id)
        ->update([
            'name' => $this->companyName,
            'email' => $this->companyEmail,
            'address' => $this->companyAddress,
            'image' => $imagePhoto,
        ]);

        alert()->success('Success', 'Company Updated.')->showConfirmButton('Okay', '#f55247');
        redirect()->route('superadmin.company.show', $company->id);
    }

    public function render()
    {
        return view('livewire.company-super-admin.edit');
    }
}
