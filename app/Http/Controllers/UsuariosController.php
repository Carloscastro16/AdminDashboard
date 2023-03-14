<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class UsuariosController extends Controller
{
    public function __construct()
    {
        //funcion que valida solamente un usario autenticado puede tener acceso
        $this -> middleware('auth');
    }
    //Funcion que se ejecuta cuando se da click en el boton Guardar perfil//
    public function MiPerfilUpdate(Request $request){
        //Verificar si el correo actual es diferente al correo enviado
        //Lo que significa que se requiere actualizar
        if(auth()-> user()->email !=request('email')){
            //Si se requiere actualizar la contrasena
            if(request('passwordN')){
                //Se crea un array con los datos validados
                //Si los datos no cumplen las reglas de validacion no se considera para actualizar 
                $datos = request()-> validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'unique:users'],
                    'passwordN' => ['required', 'string', 'min:3']
                ]);
            }else{
                $datos = request()-> validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'unique:users']
                ]);
            }
            //si no se requiere actualizar el correo
        }else{
            if(request('paswordN')){
                $datos = request()-> validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email'],
                    'passwordN' => ['required', 'string', 'min:3']
                ]);
            }else{
                $datos = request()-> validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email']
                ]);
            }
        } 
        //si se requiere actualizar el documento
        if(request('documento')){
            $documento = $request['documento'];
        }else{
            $documento = auth()->user() -> documento;
        }
        //si se requiere actualizar la foto
        if(request('fotoPerfil')){
            Storage::delete('public/'.auth()->user()-> foto);
            $rutaImg = $request['fotoPerfil']->store('usuarios/'.$datos["name"],'public');
        }else{
            $rutaImg = auth()->user() ->foto;
        }
        //si se requiere actualizar la contrasena y cumple con las reglas
        if(isset($datos["passwordN"])){
            DB::table('users') -> where ('id',auth() -> user()-> id) ->update(['name' => $datos ["name"],
            'email' => $datos["email"],'documento'=>$documento, 'foto' =>$rutaImg,
            'password' => Hash::make(request("passwordN"))]);
        }else{
            DB::table('users') -> where ('id',auth() -> user()-> id) ->update(['name' => $datos ["name"],
            'email' => $datos["email"],'documento'=>$documento, 'foto' =>$rutaImg]);
        }
        return redirect('MiPerfil');
    }
    public function Miperfil(){
        return view ('modulos.MiPerfil');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuarios::all();
        return view('modulos.Usuarios')-> with ('usuarios',$usuarios);
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
        //Validar los datos recibidos
        $datos = request()-> validate([
            'name' => ['string', 'max:255'],
            'rol' => ['required'],
            'email' => ['string', 'unique:users'],
            'password' => ['string', 'min:3']
        ]);
        //crear el registro en la tabla users en la bd
        Usuarios::create([
            'name' => $datos['name'],
            'email' => $datos['email'],
            'rol' => $datos['rol'],
            'password' => Hash::make($datos['password']),
            'documento' => '',
            'foto' => ''
        ]);
        //redireccionamos a la vista usuarios, al llamar a la ruta Usuarios
    return redirect('Usuarios') -> with('UsuarioCreado','OK');
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