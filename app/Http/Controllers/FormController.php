<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function create(){
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            Form::create($attributes);
            return "Your Record is saved Successfully !!";
        } catch (\Exception $e) {
            // Log the error message or use dd($e) to debug the exception
            return "An error occurred while saving the record :: " . $e;
        }

    }
}
