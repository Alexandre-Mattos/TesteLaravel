<?php

namespace App\Http\Controllers;

use App\Models\Universidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UniversidadeController extends Controller
{

    public function index() {

        $dbUniversidades = Universidades::query()->count();
        if($dbUniversidades === 0) {
            $request = Http::get("http://universities.hipolabs.com/search?country=United+States", [
                'limit' => 1,
            ]);

            $universidades = collect(json_decode($request->body()))->take(100);

            $universidades->each(function ($universidade) {
                Universidades::create([
                    'name'           => $universidade->name,
                    'country'        => $universidade->country,
                    'domains'        => $universidade->domains[0],
                    'web_pages'      => $universidade->web_pages[0],
                    'alpha_two_code' => $universidade->alpha_two_code,
                    ]);

            });
        }
        $dbUniversidades = Universidades::query()->get();
        return response()->json([
            'Universidades' => $dbUniversidades,]);
    }
}
