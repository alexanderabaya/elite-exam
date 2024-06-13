<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function redirectAlert($type,$title,$message,$buttonText,$route,$parameters = null){
        alert($title, $message, $type)->showConfirmButton($buttonText, '#f55247');
        return redirect()->route($route,$parameters);
    }
}
