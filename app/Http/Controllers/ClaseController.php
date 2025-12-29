<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClaseRequest;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Disciplina;
use Illuminate\Support\Facades\Storage;


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
        $disciplinas = Disciplina::all();
        return view('clases.create', compact('disciplinas'));
    }

    public function store(ClaseRequest $request) {
        // Lógica para almacenar una nueva clase 
        // $datos=$request->validated();
        $clase = new Clase();
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('videos', 'public');
            $clase->url_video = $path;
        } else {
            $clase->url_video = $request->url_video;
        }
        $clase->titulo = $request->titulo;
        $clase->descripcion = $request->descripcion;
        $clase->disciplina_id = $request->disciplina_id;
        $clase->nivel = $request->nivel;

        $clase->save();
        return redirect()->route('clases.index')->with('success', 'Clase creada con éxito.');
    }

    public function destroy($id) {
        $clase = Clase::findOrFail($id);

        if (!auth()->user()->is_admin) {
            abort(403, 'No autorizado para eliminar esta clase.');
        }
        if ($clase->url_video && !str_starts_with($clase->url_video, 'http') && Storage::disk('public')->exists($clase->url_video)) {
            Storage::disk('public')->delete($clase->url_video);
        }
        $clase->delete();
        return redirect()->route('clases.index')->with('success', 'Clase eliminada correctamente.');
    }
}
