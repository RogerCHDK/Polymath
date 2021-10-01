<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaPostRequest;
use App\Http\Requests\EmpresaUpdateRequest;
use App\Http\Resources\EmpresaCollection;
use App\Http\Resources\EmpresaResource;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::paginate(10);
        return new EmpresaCollection($empresa);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaPostRequest $request)
    {
        $request->validated();
        $logotipo = $request->file('logotipo'); 

        if ($logotipo) {
            $logotipo_nombre = time().'_'.$logotipo->getClientOriginalName();
            Storage::disk('public')->put($logotipo_nombre, File::get($logotipo));
            $request->logotipo = $logotipo_nombre;
            }

        $empresa = Empresa::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'logotipo' => $request->logotipo,
            'sitio_web' => $request->sitio_web
        ]);

        return response()->json([
            'message' => 'Ok empresa creada'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return new EmpresaResource($empresa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaUpdateRequest $request, Empresa $empresa)
    {
        $request->validated();
        $logotipo = $request->file('logotipo'); 
        if ($logotipo) {
            $logotipo_nombre = time().'_'.$logotipo->getClientOriginalName();
            //Save the new logotipo
            Storage::disk('public')->put($logotipo_nombre, File::get($logotipo));
            //Delete the previuos logotipo
            Storage::disk('public')->delete($empresa->logotipo);
            $request->logotipo = $logotipo_nombre;
            }

        $empresa->nombre = ($request->nombre) ? $request->nombre : $empresa->nombre;
        $empresa->email = ($request->email) ? $request->email : $empresa->email;
        $empresa->logotipo = ($request->logotipo) ? $request->logotipo : $empresa->logotipo;
        $empresa->sitio_web = ($request->sitio_web) ? $request->sitio_web : $empresa->sitio_web;
        $empresa->save();

        return response()->json([
            'message' => "Empresa actualizada correctamente"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        // Delete logotipo de la empres si existe 
        if ($empresa->logotipo) {
            Storage::disk('public')->delete($empresa->logotipo);
        }
        $empresa->delete();
        return response()->json([
            'message' => "Empresa eliminada correctamente"
        ], 204);
    }
}
