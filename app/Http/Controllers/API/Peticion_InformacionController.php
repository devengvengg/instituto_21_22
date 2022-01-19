<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\peticion_informacion;
use Illuminate\Http\Request;
use App\Http\Resources\PeticionInformacionResource;

class Peticion_InformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return PeticionInformacionResource::collection(peticion_informacion::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $peticion_informacion = json_decode($request->getContent(), true);
        $peticion_informacion = peticion_informacion::create($peticion_informacion);
        return new PeticionInformacionResource($peticion_informacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peticion_informacion  $peticion_informacion
     * @return \Illuminate\Http\Response
     */
    public function show(peticion_informacion $peticion_informacion) {
        return new PeticionInformacionResource($peticion_informacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peticion_informacion  $peticion_informacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peticion_informacion $peticion_informacion) {
	$peticion_informacionData = json_decode($request->getContent(), true);
	$peticion_informacion->update($peticion_informacionData);
	return new PeticionInformacionResource($peticion_informacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peticion_informacion  $peticion_informacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(peticion_informacion $peticion_informacion) {
        $peticion_informacion->delete();
    }
}
