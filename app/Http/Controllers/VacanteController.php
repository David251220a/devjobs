<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Experiencia;
use App\Salario;
use App\Ubicacion;
use App\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{

    public function  __construct()
    {
        $this->middleware(['auth', 'verified'], ['except' => 'show']);
    }

    public function index()
    {
        $vacantes= Vacante::where('user_id', auth()->user()->id)
        ->simplePaginate(3);

        return view('vacantes.index', compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();
        return view('vacantes.create', compact('categorias', 'experiencias', 'ubicaciones', 'salarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "titulo" => 'required|min:8',
            "categoria" => 'required',
            "experiencia" => 'required',
            "ubicacion" => 'required',
            "salario" => 'required',
            "descripcion" => 'required|min:50',
            "imagen" => 'required',
            "skills" => 'required'
        ]);

        // Almacenar en la BD con usuario autenticado
        auth()->user()->vacantes()->create([
            'titulo' => $data['titulo'],
            'imagen' => $data['imagen'],
            'skills' => $data['skills'],
            'descripcion' => $data['descripcion'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario']
        ]);

        return redirect()->route('vacantes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', compact('vacante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {

        $this->authorize('view', $vacante);

        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();
        return view('vacantes.edit', compact('vacante', 'categorias', 'experiencias', 'ubicaciones', 'salarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {

        $this->authorize('update', $vacante);

        $data = $request->validate([
            "titulo" => 'required|min:8',
            "categoria" => 'required',
            "experiencia" => 'required',
            "ubicacion" => 'required',
            "salario" => 'required',
            "descripcion" => 'required|min:50',
            "imagen" => 'required',
            "skills" => 'required'
        ]);

        $vacante->update([
            'titulo' => $data['titulo'],
            'imagen' => $data['imagen'],
            'skills' => $data['skills'],
            'descripcion' => $data['descripcion'],
            'categoria_id' => $data['categoria'],
            'experiencia_id' => $data['experiencia'],
            'ubicacion_id' => $data['ubicacion'],
            'salario_id' => $data['salario']
        ]);

        return redirect()->route('vacantes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante)
    {
        $this->authorize('delete', $vacante);

        $vacante->delete();

        return response()->json(['mensaje' => 'Se elimino la vacante '. $vacante->titulo]);
    }

    public function imagen(Request $request){

        $imagen = $request->file('file');
        $nombreimagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/vacantes'), $nombreimagen);

        return response()->json(['correcto' => $nombreimagen]);

    }

    public function borrarimagen(Request $request){

        if($request->ajax()){
            $imagen = $request->get('imagen');
            if(File::exists('storage/vacantes/' . $imagen)){

                File::delete('storage/vacantes/' . $imagen);

            }

            return response('Imagen Eliminada', 200);
        }

    }

    public function estadovacante(Request $request, Vacante $vacante){

        $vacante->activa = $request->estado;

        $vacante->save();

        return response()->json(['respuesta' => 'Correcto']);
    }

    public function buscar(Request $request){

        //dd($request->all());

        $data = $request->validate([
            'categoria' => 'required',
            'ubicacion' => 'required',
        ]);

        $categoria = $data['categoria'];
        $ubicacion  = $data['ubicacion'];

        $vacantes = Vacante::latest()
        ->where('categoria_id', $categoria)
        ->orWhere('ubicacion_id', $ubicacion)
        ->get();
        // $vacantes = Vacante::where([
        //     'categoria_id' => $categoria,
        //     'ubicacion_id' => $ubicacion
        // ])
        // ->latest()
        // ->get();

        return view('buscar.index', compact('vacantes'));

    }

    public function resultado(){

    }

}
