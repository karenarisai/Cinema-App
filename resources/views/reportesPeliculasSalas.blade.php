<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Películas y Salas</title>
    <style>
        /* Estilos para el PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h1>Reporte de Películas y Salas</h1>
    <table>
        <thead>
            <tr>
                <th>Película</th>
                <th>Horario</th>
                <th>Costo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($funciones as $funcion)
                    <tr>
                        @foreach($peliculas as $pelicula)
                            @if($funcion->pelicula_id === $pelicula->id)
                                <td>{{ $pelicula->nombre }}</td>
                            @endif
                        @endforeach    
                        <td>{{ $funcion->fecha }}</td>
                        <td>${{ number_format($funcion->costo, 2) }}</td>
                    </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
