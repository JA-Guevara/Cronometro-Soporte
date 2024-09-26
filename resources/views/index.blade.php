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
            <div class="card-header text-center">
                <h3 class="card-title">Inicio De Sesión</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('check') }}">
                    @csrf
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" value="{{ $username }}" class="form-control" readonly>
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
        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Asegurar que ocupe toda la altura */
            padding: 20px;
            box-sizing: border-box;
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
            width: 100%;
            padding: .375rem .75rem;
            border: 1px solid #ced4da;
            border-radius: .375rem;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            border-radius: .375rem;
            padding: .375rem .75rem;
            cursor: pointer;
            margin: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        /* Estilos del encabezado */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            width: 100%;
        }

        .custom-header {
            font-family: 'Roboto', sans-serif;
            font-size: 1.25rem;
            font-weight: bold;
            color: white;
            background-color: #002855; /* Azul marino */
            padding: 10px;
            border-radius: 10px;
        }

        .logo-image {
            height: 70px;
        }

        /* Estilos para el footer */
        .footer {
            position: fixed;
            bottom: 0;
            right: 0;
            background-color: transparent;
            color: silver;
            text-align: center;
            padding: 10px;
            font-family: 'Roboto', sans-serif;
            font-size: 0.875rem;
            margin: 0;
            width: 100%;
            box-sizing: border-box;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .custom-header {
                font-size: 1rem;
            }

            .logo-image {
                height: 40px;
            }

            .content-container {
                padding: 10px;
                max-width: 90%;
            }
        }
    </style>
@stop

@section('js')
    <script> console.log('Pantalla Principal cargada.'); </script>
@stop

@section('footer')
    <div class="footer">
        <p>by > Jose Armando Guevara Caballero</p>
    </div>
@stop
