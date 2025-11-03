<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrosController extends Controller
{
    public function get_index()
    {
        $carros = [
            ['marca' => 'Fiat', 'modelo' => 'Uno', 'ano' => 2015, 'imagem' => 'fiat_uno.jpg'],
            ['marca' => 'Volkswagen', 'modelo' => 'Gol', 'ano' => 2018, 'imagem' => 'vw_gol.jpg'],
            ['marca' => 'Chevrolet', 'modelo' => 'Onix', 'ano' => 2020, 'imagem' => 'chevrolet_onix.jpg'],
            ['marca' => 'Ford', 'modelo' => 'Ka', 'ano' => 2019, 'imagem' => 'ford_ka.jpg'],
            ['marca' => 'Honda', 'modelo' => 'Civic', 'ano' => 2021, 'imagem' => 'honda_civic.jpg'],
            ['marca' => 'BMW', 'modelo' => 'X5', 'ano' => 2022, 'imagem' => 'bmw_x5.jpg'],
            ['marca' => 'Audi', 'modelo' => 'A4', 'ano' => 2020, 'imagem' => 'audi_a4.jpg'],
            ['marca' => 'Mercedes', 'modelo' => 'C300', 'ano' => 2021, 'imagem' => 'mercedes_c300.jpg'],
        ];

        return view('site.projects.cars', compact('carros'));
    }
}
