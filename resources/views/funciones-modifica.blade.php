<x-layouts.app>
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Modifica funciones</flux:heading>
            <flux:text class="mt-2">Modifica los detalles de las funciones.</flux:text>
        </div>

        <form method="POST" action="{{ route('funciones.update', $funcion->id) }}">
            @csrf

            {{-- Seleccionar Película --}}
            <div class="mt-4">
                <label for="pelicula_id" class="block mb-2 font-semibold">Película</label>
                <select id="pelicula_id" name="pelicula_id" class="w-full border rounded-lg p-2">
                    @foreach ($peliculas as $pelicula)
                        <option value="{{ $pelicula->id }}" {{ $pelicula->id == $funcion->pelicula_id ? 'selected' : '' }}>
                            {{ $pelicula->titulo }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Seleccionar Sala --}}
            <div class="mt-4">
                <label for="sala_id" class="block mb-2 font-semibold">Sala</label>
                <select id="sala_id" name="sala_id" class="w-full border rounded-lg p-2">
                    @foreach ($salas as $sala)
                        <option value="{{ $sala->id }}" {{ $sala->id == $funcion->sala_id ? 'selected' : '' }}>
                            {{ $sala->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha --}}
            <div class="mt-4">
                <flux:input 
                    label="Fecha y hora" 
                    type="datetime-local" 
                    name="fecha" 
                    value="{{ $funcion->fecha }}" 
                    class="w-full" />
            </div>

            {{-- Tipo --}}
            <div class="mt-4">
                <flux:input 
                    label="Tipo" 
                    type="text" 
                    name="tipo" 
                    value="{{ $funcion->tipo }}" 
                    class="w-full" />
            </div>

            {{-- Costo --}}
            <div class="mt-4">
                <flux:input 
                    label="Costo" 
                    type="number" 
                    name="costo" 
                    value="{{ $funcion->costo }}" 
                    class="w-full" />
            </div>

            <div class="flex mt-6">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Guardar cambios</flux:button>
            </div>
        </form>
    </div>
</x-layouts.app>
