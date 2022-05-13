<?php

namespace App\Http\Controllers;

use App\Models\Universidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UniversidadeController extends Controller
{

    public function index() {
        $request = Http::get("http://universities.hipolabs.com/search?country=United+States", [
            'limit' => 1,
        ]);

        $universidades = collect(json_decode($request->body()))->take(100);

        $novasUniversidadesCadastradas = collect();
        $universidades->each(function ($universidade) use ($novasUniversidadesCadastradas){
            $novaUniversidade = Universidades::make();
            $novaUniversidade->name = $universidade->name;
            $novaUniversidade->alpha_two_code = $universidade->alpha_two_code;
            $novaUniversidade->country = $universidade->country;
            $novaUniversidade->domains = $universidade->domains;
            $novaUniversidade->web_pages = $universidade->web_pages;
            $novaUniversidade->save();
            $novasUniversidadesCadastradas->push($novaUniversidade);
        });
        return response()->json([$novasUniversidadesCadastradas]);
    }
}
