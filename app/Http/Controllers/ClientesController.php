<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Clientes::all();
        return view('modulos.Clientes')-> with ('clientes',$clientes);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = request();
        //crear el registro en la tabla users en la bd
        Clientes::create([
            'nombre' => $datos['name'],
            'email' => $datos['email'],
            'documento' => $datos['documento'],
            'fechaNac' => $datos['fechaNac'],
            'telefono' => $datos['telefono'],
            'password' => Hash::make($datos['password']),
        ]);
        //redireccionamos a la vista usuarios, al llamar a la ruta Usuarios
    return redirect('Clientes') -> with('UsuarioCreado','OK');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = Clientes::find($id);

        $user->nombre = $request->input('name');
        $user->email = $request->input('email');
        $user->documento = $request->input('documento');
        $user->fechaNac = $request->input('fechaNac');
        $user->telefono = $request->input('telefono');
        $user->save();

        return redirect()->back()->with('UsuarioActualizado', 'OK');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $clientes = Clientes::find($id);
        Clientes::destroy($id);
        return redirect('Clientes');
    }
}
