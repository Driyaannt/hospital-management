<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekamMedikController extends Controller
{
    public function index()
    {
        return view('layouts.create-rm.create-rm');
    }
}
