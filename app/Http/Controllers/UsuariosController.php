<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function MiPerfil()
    {
        return view('modulos.MiPerfil');
    }

    public function MiPerfilUpdate(Request $request){
        //Verificar si el correo actual es diferente al correo Nuevo
        if(auth()->user()->email != request('email')){
            //Si se quiere actualizar la contraseña hace esto
            if(request('passwordN')){
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'unique:users'],
                    'passwordN' => ['required', 'string', 'min:3']
                ]);
            //Sino se quiere actualizar la contraseña
            }else{
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'unique:users']
                ]);
            }
        //Sino se quiere actualizar el correo
        }else{
            if(request('passwordN')){
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email'],
                    'passwordN' => ['required', 'string', 'min:3']
                ]);
            }else{
                $datos = request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'unique:users']
                ]);
            }
        }

        //Si se requiere actualizar el documento
        if(request('documento')){
            $documento = request['documento'];
        }else{
            $documento = auth()->user()->documento;
        }

        //Si se quiere actualizar la foto
        if(request('fotoPerfil')){
            Storage::delete('public/'.auth()->user()->foto);
            $rutaImg = $request['fotoPerfil']->store('usuarios/'.$datos["name"], 'public');
        }else{
            $rutaImg = auth()->user()->foto;
        }

        //Si se quiere actualizar la contraseña y cumple con la regla
        if(isset($datos["passwordN"])){
            DB::table('users')->where('id', auth()->user()->id)->update(['name'=>$datos["name"],
            'email'=> $datos["email"], 'documento'=>$documento, 'foto'=>$rutaImg,
            'password'=>Hash::make(request("psaswordN"))]);
        }else{
            DB::table('users')->where('id', auth()->user()->id)->update(['name'=>$datos["name"],
            'email'=> $datos["email"], 'documento'=>$documento, 'foto'=>$rutaImg]);
        }

        return redirect('perfil');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
