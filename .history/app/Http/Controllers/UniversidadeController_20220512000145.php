<?php

namespace App\Http\Controllers;

use App\Models\Universidades;
use Illuminate\Http\Request;

class UniversidadeController extends Controller
{
    public function load() {
        $universidades = new Universidades();
        $url = "http://universities.hipolabs.com/search?country=United+States";

        $response = $universidades->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/json',
                ]
            ]);
        return response()->json([$universidades]);
    }
}
