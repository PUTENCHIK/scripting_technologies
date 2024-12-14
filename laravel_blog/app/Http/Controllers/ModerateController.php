<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModerateController extends Controller
{
    public function index()
    {
        return view('moderate.index');
    }
}
