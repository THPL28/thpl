<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    // Função que retorna a view da agenda
    public function get_index()
    {
        return view('site.projects.agenda'); 
    }
}
