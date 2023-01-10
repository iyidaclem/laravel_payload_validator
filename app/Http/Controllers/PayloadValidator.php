<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PayloadValidator extends Controller
{
    public function index(Request $request)
    {
      return ValidatorEngine::validatePayload($request->all());
    }

 
}
