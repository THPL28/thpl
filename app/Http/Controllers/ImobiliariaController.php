<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImobiliariaController extends Controller
{
    public function get_index()
    {
         return view('site.projects.imobiliaria');
    }
}
