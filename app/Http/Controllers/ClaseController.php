<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClaseRequest;
use Illuminate\Http\Request;
use App\Models\Clase;


class ClaseController extends Controller {
    public function index() {
        $clases = Clase::with('disciplina')->get();
        return view('clases.index', compact('clases'));
    }

    public function show($id) {
        $clase = Clase::with('disciplina')->findOrFail($id);
        return view('clases.show', compact('clase'));
    }

    public function create() {
        $disciplinas = \App\Models\Disciplina::all();
        return view('clases.create', compact('disciplinas'));
    }

    public function store(ClaseRequest $request) {
        // Lógica para almacenar una nueva clase 
        // $datos=$request->validated();
        $clase = new Clase();
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('videos', 'public');
            $clase->url_video = $path;
        }else{
            $clase->url_video = $request->url_video;
        }
        $clase->titulo = $request->titulo;
        $clase->descripcion = $request->descripcion;
        $clase->disciplina_id = $request->disciplina_id;
        $clase->nivel = $request->nivel;

        $clase->save();
        return redirect()->route('clases.index')->with('success', 'Clase creada con éxito.');
    }
}
