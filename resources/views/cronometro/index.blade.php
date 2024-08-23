@extends('adminlte::page')

@section('title', 'Cronómetro')

@section('content_header')
    <div class="custom-header d-flex justify-content-between align-items-center">
        <h1 style="margin: 0;">Cronómetro</h1>
        <a href="{{ url('/') }}" class="btn custom-exit-button">Salir</a>
    </div>
@stop

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Control del Cronómetro (izquierda) -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header custom-card-header text-center d-flex justify-content-center align-items-center">
                        <h3 class="card-title font-weight-bold">Control del Cronómetro</h3>
                    </div>
                    <div class="card-body">
                        <form id="cronometroForm" action="{{ route('cronometro.start') }}" method="POST">
                            @csrf
                            <input type="hidden" name="operador_id" value="{{ $operador->id ?? '' }}">
                            @if($registro)
                                <input type="hidden" id="registro_id" name="registro_id" value="{{ $registro->id }}">
                            @endif
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" id="usuario" name="usuario" value="{{ $operador->usuario ?? 'No disponible' }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ci">CI:</label>
                                <input type="text" id="ci" name="ci" value="{{ $operador->ci ?? 'No disponible' }}" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nombre_operador">Nombre:</label>
                                <input type="text" id="nombre_operador" name="nombre_operador" value="{{ $operador->nombre ?? 'No disponible' }}" class="form-control" readonly>
                            </div>

                            <!-- Tiempo Transcurrido dentro del contenedor de Control del Cronómetro -->
                            <div class="form-group text-center">
                                <p id="tiempo" style="font-size: 2rem; margin-bottom: 10px;">00:00:00</p>
                            </div>

                            <!-- Botón para Iniciar/Detener el Cronómetro -->
                            <div class="form-group text-center">
                                <button type="submit" id="toggleButton" class="btn btn-success">
                                    Iniciar Cronómetro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Registros Históricos (derecha) -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header custom-card-header text-center d-flex justify-content-center align-items-center">
                        <h3 class="card-title font-weight-bold">Registros Históricos</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Hora Inicio</th>
                                    <th class="text-center">Hora Final</th>
                                    <th class="text-center">Tiempo Transcurrido</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registrosHistoricos as $registroHistorico)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($registroHistorico->fecha)->format('d-m-Y') }}</td>
                                        <td>{{ $registroHistorico->hora_inicio }}</td>
                                        <td>{{ $registroHistorico->hora_final }}</td>
                                        <td>{{ $registroHistorico->tiempo_transcurrido }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            margin-bottom: 1rem;
        }

        .table thead th {
            background-color: #f8f9fa;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Estilo para el encabezado de la página */
        .custom-header {
            background-color: #002855; /* Azul marino */
            color: white;
            font-family: 'Roboto', sans-serif; /* Aplicando la fuente Roboto */
            font-size: 2rem; /* Tamaño de fuente aumentado */
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 10px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Estilo para el botón de salir */
        .custom-exit-button {
            background-color: white;
            color: black;
            border: 2px solid #002855;
            padding: 5px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .custom-exit-button:hover {
            background-color: #f8f9fa;
            color: #002855;
        }

        /* Estilo para el encabezado de las tarjetas */
        .custom-card-header {
            background-color: orange;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem;
            font-size: 1.25rem;
            font-weight: 500;
        }

        /* Asegurar que el tamaño de letra se mantenga consistente */
        body, .table td, .table th {
            font-size: 16px; /* Ajusta este valor según lo que prefieras */
            font-family: 'Roboto', sans-serif; /* Asegúrate de que la fuente sea consistente */
        }

        .tiempo-rojo {
            font-size: 18px; /* Tamaño específico para el tiempo transcurrido */
            color: red; /* Cambia el color del texto a rojo */
            font-weight: bold; /* Hace que el texto sea negrita */
        }
    </style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cronometroActivo = {{ $registro ? 'true' : 'false' }};
        let tiempoInicio = null;
        let intervalo;
        let registroId = "{{ $registro->id ?? '' }}";
        let button = document.getElementById('toggleButton');
        let tiempoSpan = document.getElementById('tiempo');
        let form = document.getElementById('cronometroForm');

        function formatearFecha(fecha) {
            const opciones = { year: 'numeric', month: '2-digit', day: '2-digit' };
            return fecha.toLocaleDateString('es-ES', opciones).replace(/\//g, '-');
        }

        function toggleCronometro() {
            if (cronometroActivo) {
                detenerCronometro();
            } else {
                iniciarCronometro();
            }
        }

        function iniciarCronometro() {
            tiempoInicio = new Date();
            intervalo = setInterval(actualizarTiempo, 1000);
            cronometroActivo = true;

            const fechaFormateada = formatearFecha(tiempoInicio);

            // Enviar petición AJAX para iniciar el cronómetro
            $.ajax({
                url: '{{ route('cronometro.start') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    operador_id: '{{ $operador->id }}',
                    fecha: fechaFormateada, // Fecha actual formateada
                },
                success: function(response) {
                    registroId = response.registro_id;
                    button.textContent = 'Detener Cronómetro';
                    button.className = 'btn btn-danger';
                    form.action = '{{ route('cronometro.stop') }}';
                    agregarRegistroEnTabla(fechaFormateada, response.hora_inicio, 'En progreso...', 'En progreso...');
                }
            });
        }

        function detenerCronometro() {
            clearInterval(intervalo);
            cronometroActivo = false;

            // Reiniciar el tiempo transcurrido a 0
            tiempoSpan.textContent = '00:00:00';
            tiempoSpan.classList.remove('tiempo-rojo'); // Asegurarse de eliminar la clase si el cronómetro se reinicia

            // Enviar petición AJAX para detener el cronómetro
            $.ajax({
                url: '{{ route('cronometro.stop') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    registro_id: registroId,
                },
                success: function(response) {
                    button.textContent = 'Iniciar Cronómetro';
                    button.className = 'btn btn-success';
                    form.action = '{{ route('cronometro.start') }}';
                    actualizarRegistroEnTabla(response.hora_final, response.tiempo_transcurrido);
                }
            });
        }

        function actualizarTiempo() {
            const tiempoActual = new Date();
            const tiempoTranscurrido = new Date(tiempoActual - tiempoInicio);
            const horas = String(tiempoTranscurrido.getUTCHours()).padStart(2, '0');
            const minutos = String(tiempoTranscurrido.getUTCMinutes()).padStart(2, '0');
            const segundos = String(tiempoTranscurrido.getUTCSeconds()).padStart(2, '0');

            tiempoSpan.textContent = `${horas}:${minutos}:${segundos}`;

            // Cambiar el color del tiempo a rojo si han pasado más de 15 minutos (900 segundos)
            if (tiempoTranscurrido.getTime() >= 900000) { // 900,000 ms = 15 minutos
                tiempoSpan.classList.add('tiempo-rojo');
            } else {
                tiempoSpan.classList.remove('tiempo-rojo');
            }
        }

        function agregarRegistroEnTabla(fecha, horaInicio, horaFinal, tiempoTranscurrido) {
            const tabla = document.querySelector('.table tbody');
            const nuevaFila = document.createElement('tr');
            nuevaFila.innerHTML = `
                <td class="text-center">${fecha}</td>
                <td class="text-center">${horaInicio}</td>
                <td class="text-center">${horaFinal}</td>
                <td class="text-center">${tiempoTranscurrido}</td>
            `;
            tabla.prepend(nuevaFila);

            // Limitar el número de registros mostrados a 15
            const filas = tabla.querySelectorAll('tr');
            if (filas.length > 15) {
                filas[filas.length - 1].remove();
            }
        }

        function actualizarRegistroEnTabla(horaFinal, tiempoTranscurrido) {
            const tabla = document.querySelector('.table tbody');
            const primeraFila = tabla.querySelector('tr');
            primeraFila.cells[2].textContent = horaFinal;
            primeraFila.cells[3].textContent = tiempoTranscurrido;
        }

        button.addEventListener('click', function(event) {
            event.preventDefault();
            toggleCronometro();
        });

        if (cronometroActivo) {
            tiempoInicio = new Date("{{ $registro ? $registro->hora_inicio : '' }}");
            intervalo = setInterval(actualizarTiempo, 1000);
        }
        
    });
</script>
@stop
