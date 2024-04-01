<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        return view('settings.index');
    }

    public function store(){
        // todo: create app charges with trial
    }

    public function edit(){
        // todo edit charges
    }

    public function delete(){
        // todo delete charges
    }

    public function setOneTimeCharge(){
        // set one time charge
    }
}
