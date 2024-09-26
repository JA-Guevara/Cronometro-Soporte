@extends('adminlte::page')

@section('title', 'Registro')

@section('content_header')
    <h1 class="custom-header">Registro</h1>
    
@stop

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6"> <!-- Ajustar el ancho del contenedor -->
                <div class="card">
                    <div class="card-header custom-card-header text-center d-flex justify-content-center align-items-center">
                        <h3 class="card-title font-weight-bold">Ingresar Datos</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('operador.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" id="usuario" name="usuario" value="{{ $username }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ci">CI:</label>
                                <input type="text" id="ci" name="ci" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="icon" href="{{ asset('images/logo2.png') }}" type="image/png"> <!-- Favicon -->
    
    <style>
        /* Ocultar el sidebar y el navbar */
        .main-sidebar, .main-header {
            display: none;
        }

        /* Ajustar el contenido para que ocupe el espacio completo */
        .content-wrapper {
            margin-left: 0 !important;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            box-shadow: 0 0 0 0 rgba(0,0,0,.125);
            margin: 0 auto; /* Centrar la tarjeta horizontalmente */
        }

        .custom-card-header {
            background-color: orange;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .card-header h3 {
            margin: 0;
        }

        .card-body {
            padding: 1.25rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .375rem;
            box-shadow: inset 0 0 0 rgba(0,0,0,.125);
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            border-radius: .375rem;
            padding: .375rem .75rem;
            line-height: 1.5;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .custom-header {
            background-color: #002855; /* Azul marino */
            color: white;
            font-family: 'Roboto', sans-serif; /* Aplicando la fuente Roboto */
            font-size: 2rem; /* Tamaño de fuente aumentado */
            font-weight: bold;
            padding: 10px 20px;
            text-align: center;
            border-radius: 10px;
        }

        /* Estilos para el footer */
        .footer {
            position: fixed;
            bottom: 0;
            right: 0;
            background-color: transparent; /* Fondo transparente */
            color: silver;
            text-align: center;
            padding: 10px;
            font-family: 'Roboto', sans-serif;
            font-size: 0.875rem; /* Tamaño de fuente menor para el footer */
            margin: 0;
            width: 100%;
            box-sizing: border-box;
        }

        /* Estilos adicionales para centrar y alinear el contenedor del formulario */
        .row.justify-content-center {
            display: flex;
            justify-content: center;
        }

        .col-lg-8,
        .col-xl-6 {
            width: 100%;
        }
    </style>
@stop

@section('js')
    <script> console.log('Formulario de registro cargado.'); </script>
@stop
