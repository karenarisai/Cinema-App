<x-layouts.app>
    <div>
        <h2>Funciones</h2>
        <flux:modal.trigger name="create-funcion">
            <flux:button>Agregar función</flux:button>
        </flux:modal.trigger>

        <div class="mt-2">
            <table class="w-full border border-black">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Película</th>
                        <th>Sala</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Costo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($funciones as $funcion)
                        <tr class="border border-b-black py-2">
                            <td>{{ $funcion->id }}</td>
                            <td>
                                @foreach($peliculas as $pelicula)
                                    @if($funcion->pelicula_id == $pelicula->id)
                                        {{ $pelicula->nombre }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($salas as $sala)
                                    @if($funcion->sala_id == $sala->id)
                                        {{ $sala->nombre }}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $funcion->fecha }}</td>
                            <td>{{ $funcion->tipo }}</td>
                            <td>${{ number_format($funcion->costo, 2) }}</td>
                            <td class="flex items-center justify-around">
                                <form method="POST" action="{{ route('funciones.delete', $funcion->id) }}">
                                    @csrf
                                    <flux:button type="submit">Eliminar</flux:button>
                                </form>
                                <flux:brand href="{{ route('funciones.show', $funcion->id) }}" name="Modificar"></flux:brand>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <flux:modal name="create-funcion" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Agregar función</flux:heading>
                <flux:text class="mt-2">Agrega los detalles de la función.</flux:text>
            </div>

            <form method="POST" action="{{ route('funciones.save') }}">
                @csrf

                <flux:select wire:model="pelicula_id" label="Película" placeholder="Selecciona película">
                    @foreach($peliculas as $pelicula)
                        <flux:select.option value="{{ $pelicula->id }}">{{ $pelicula->nombre }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model="sala_id" label="Sala" placeholder="Selecciona sala">
                    @foreach($salas as $sala)
                        <flux:select.option value="{{ $sala->id }}">{{ $sala->nombre }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:input label="Fecha" type="datetime-local" name="fecha" />
                <flux:input label="Tipo de función" type="text" name="tipo" placeholder="Ej: 3D, 2D, subtitulada" />
                <flux:input label="Costo" type="number" name="costo" step="0.01" />

                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Guardar</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</x-layouts.app>
