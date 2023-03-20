@extends('plantilla')

@section('contenido')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Gestor de clientes</h1>
        </section>
        <section class="content">
            <div class="box">
                <div class="box-header">
                    <button class="btn btn-primary" data-toggle="modal"
                    data-target="#CrearUsuario" >Crear Nuevo</button>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover table-striped dtUsers">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>FechaNac</th>
                                <th>Email</th>
                                <th>Telefono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $user)
                                <tr>
                                    <td>{{ $user->nombre }}</td>
                                @if($user -> documento == "")
                                    <td>No Registrado</td>
                                @else
                                    <td>{{ $user->documento }}</td>
                                @endif
                                    <td>{{ $user->fechaNac }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->telefono }}</td>
                                    <td>
                                        <button class="btn btn-success"><i class="fas fa-pencil-alt" 
                                            data-toggle="modal" data-target="#EditarCliente{{ $user->id }}"></i></button>
                                        <button class="btn btn-danger EliminarCliente" Uid="{{$user->id}}" Usuario="{{ $user->nombre }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <div class="modal fade" id="EditarCliente{{ $user->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('clientes.actualizar', ['id' => $user->id]) }}">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="box-body">
                                                                <input type="hidden" name="user_id" value="{{$user -> id}}">
                                                                <div class="form-group">
                                                                    <h2>Nombre</h2>
                                                                    <input type="text" class="form-control input-lg" name="name" id="name" value="{{$user -> nombre}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h2>Email</h2>
                                                                    <input type="email" class="form-control input-lg" name="email" id="email" value="{{$user -> email}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h2>Documento</h2>
                                                                    <input type="text" class="form-control input-lg" name="documento" id="documento" value="{{$user -> documento}}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h2>Fecha de Nacimiento</h2>
                                                                    <input type="text" class="form-control input-lg" value="{{$user -> fechaNac}}" name="fechaNac" id="fechaNac" data-inputmask='"alias": "datetime", "inputFormat": "dd/mm/yyyy"' data-mask required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h2>Telefono</h2>
                                                                    <input type="text" class="form-control input-lg" name="telefono" id="telefono" data-inputmask="
                                                                    'mask': '+(99) 99-99-99-99'" data-mask value="{{$user -> telefono}}" required>
                                                                </div>
                                                                {{-- <div class="form-group">
                                                                    <h2>Contraseña</h2>
                                                                    <input type="password" class="form-control input-lg" name="password" required>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Modificar</button>
                                                            <button type="button" class="btn btn-danger" 
                                                            data-dismiss="modal">Cancelar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="CrearUsuario">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">
                    @csrf
                    
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <h2>Nombre</h2>
                                <input type="text" class="form-control input-lg" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <h2>Email</h2>
                                <input type="email" class="form-control input-lg" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <h2>Documento</h2>
                                <input type="text" class="form-control input-lg" name="documento" id="documento" required>
                            </div>
                            <div class="form-group">
                                <h2>Fecha de Nacimiento</h2>
                                <input type="text" class="form-control input-lg" name="fechaNac" id="fechaNac" 
                                data-inputmask='"alias": "datetime", "inputFormat": "dd/mm/yyyy"' data-mask required>
                            </div>
                            <div class="form-group">
                                <h2>Telefono</h2>
                                <input type="text" class="form-control input-lg" name="telefono" id="telefono" data-inputmask="
                                'mask': '+(99) 99-99-99-99'" data-mask required>
                            </div>
                            <div class="form-group">
                                <h2>Contraseña</h2>
                                <input type="password" class="form-control input-lg" name="password" id="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Crear</button>
                        <button type="button" class="btn btn-danger" 
                        data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection