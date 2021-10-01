<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleadoPostRequest;
use App\Http\Requests\EmpleadoUpdateRequest;
use App\Http\Resources\EmpleadoCollection;
use App\Http\Resources\EmpleadoResource;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleado = Empleado::paginate(10);
        return new EmpleadoCollection($empleado);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoPostRequest $request)
    {
        $request->validated();
        $empleado = Empleado::create($request->all());
        return response()->json([
            'message' => 'Ok empleado creado'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        return new EmpleadoResource($empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoUpdateRequest $request, Empleado $empleado)
    {
        $request->validated();
        $empleado->update($request->all());
        return response()->json([
            'message' => "Empleado actualizado correctamente"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return response()->json([
            'message' => "Empleado eliminado correctamente"
        ], 204);
    }
}
