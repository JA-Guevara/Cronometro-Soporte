@extends('adminlte::page')

@section('title', 'Cronómetro - Conecta')

@section('content_header')
    <div class="header-container">
        <h1 class="custom-header">Soporte de Bots</h1>
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-image">
    </div>
@stop

@section('content')
    <div class="content-container">
        <div class="card">
            <div class="card-header text-center d-flex justify-content-center align-items-center">
                <h3 class="card-title font-weight-bold">Inicio De Sesión</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('check') }}">
                    @csrf
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" value="{{ getenv('USERNAME') }}" class="form-control" readonly>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" name="action" value="ingresar" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet"> <!-- Fuente Roboto -->
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

        /* Estilo para centrar el contenedor */
        .vh-100 {
            height: 100vh;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        /* Estilos del contenedor del encabezado */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Estilos personalizados para el encabezado */
        .custom-header {
            font-family: 'Roboto', sans-serif; /* Aplicando la fuente Roboto */
            font-size: 1.25rem; /* Tamaño de la fuente ajustado */
            font-weight: bold;
            margin: 0;
            flex-grow: 1;
            text-align: center;
            color: white;
            background-color: #002855; /* Azul marino */
            padding: 10px;
            border-radius: 10px;
        }

        .logo-image {
            height: 70px; /* Tamaño del logo ajustado */
        }

        /* Estilos del contenedor del contenido */
        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto; /* Ajustar la altura automática para el contenedor */
            padding: 20px;
            width: 100%;
            max-width: 600px; /* Limitar el ancho máximo del contenedor */
            box-sizing: border-box;
            margin: 0 auto; /* Centrar el contenedor */
        }

        .card {
            width: 100%;
            max-width: 400px;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            box-shadow: 0 0 0 0 rgba(0,0,0,.125);
        }

        .card-header {
            background-color: orange;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
            font-size: 1.25rem;
            font-weight: 500;
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
            margin: 5px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
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

        /* Media Queries para la adaptabilidad */
        @media (max-width: 768px) {
            .custom-header {
                font-size: 1rem; /* Ajustar el tamaño de la fuente en pantallas más pequeñas */
            }

            .logo-image {
                height: 40px; /* Tamaño del logo ajustado para pantallas más pequeñas */
            }

            .content-container {
                padding: 10px;
                max-width: 90%; /* Ajustar el ancho máximo en pantallas más pequeñas */
            }
        }
    </style>
@stop

@section('js')
    <script> console.log('Pantalla Principal cargada.'); </script>
@stop

@section('footer')
    <div class="footer">
        <p>by> Jose Armando Guevara Caballero</p>
    </div>
@stop
