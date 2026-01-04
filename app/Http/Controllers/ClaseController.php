<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClaseRequest;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Disciplina;
use Illuminate\Support\Facades\Storage;


class ClaseController extends Controller {
    public function index(Request $request) {
        
        $query= Clase::with('disciplina');

        if($request->filled('disciplina_id')){
            $query->where('disciplina_id', $request->disciplina_id);
        }
        if($request->filled('nivel')){
            $query->where('nivel', $request->nivel);
        }

        $clases = $query->paginate(9)->withQueryString();
        $disciplinas = Disciplina::all();

        return view('clases.index', compact('clases', 'disciplinas'));
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
        // Texto envuelto en __()
        return redirect()->route('clases.index')->with('success', __('Clase creada con éxito.'));
    }

    public function edit($id) {
        $clase = Clase::findOrFail($id);
        $disciplinas = Disciplina::all();
        return view('clases.edit', compact('clase', 'disciplinas'));
    }

    public function update(ClaseRequest $request, $id) {
        $clase = Clase::findOrFail($id);

        if (auth()->check() && !auth()->user()->is_admin) {
            // Texto envuelto en __()
            abort(403, __('No autorizado para editar esta clase.'));
        }
        if ($request->hasFile('video_file') || $request->filled('url_video')) {
            if ($clase->url_video && !str_starts_with($clase->url_video, 'http') && Storage::disk('public')->exists($clase->url_video)) {
                Storage::disk('public')->delete($clase->url_video);
            }
            if ($request->hasFile('video_file')) {
                $path = $request->file('video_file')->store('videos', 'public');
                $clase->url_video = $path;
            } else {
                $clase->url_video = $request->url_video;
            }
        }
        $clase->titulo = $request->titulo;
        $clase->descripcion = $request->descripcion;
        $clase->disciplina_id = $request->disciplina_id;
        $clase->nivel = $request->nivel;
        $clase->save();

        // Texto envuelto en __()
        return redirect()->route('clases.show', $clase->id)->with('success', __('Clase actualizada correctamente.'));
    }

    public function destroy($id) {
        $clase = Clase::findOrFail($id);

        if (!auth()->user()->is_admin) {
            // Texto envuelto en __()
            abort(403, __('No autorizado para eliminar esta clase.'));
        }
        if ($clase->url_video && !str_starts_with($clase->url_video, 'http') && Storage::disk('public')->exists($clase->url_video)) {
            Storage::disk('public')->delete($clase->url_video);
        }
        $clase->delete();
        // Texto envuelto en __()
        return redirect()->route('clases.index')->with('success', __('Clase eliminada correctamente.'));
    }
}