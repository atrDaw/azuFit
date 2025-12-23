<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller {
    public function index(){
        $clases=Clase::with('disciplina')->get();
        return view('clases.index', compact('clases'));
    }

    public function show($id){
        $clase=Clase::with('disciplina')->findOrFail($id);
        return view('clases.show', compact('clase'));
    }
}
