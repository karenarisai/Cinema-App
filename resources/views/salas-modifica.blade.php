<x-layouts.app>

    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Modifica salas</flux:heading>
            <flux:text class="mt-2">Modifica los detalles de las salas.</flux:text>
        </div>

        <form METHOD='POST' action='{{ route('salas.update', $sala->id) }}'>
            @csrf
            <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre' value='{{ $sala->nombre }}'/>
            <flux:input label="Capacidad" placeholder="Capacidad" wire:model='capacidad' value='{{ $sala->capacidad }}'/>
            <flux:input label="Tipo" placeholder="Tipo" wire:model='tipo' value='{{ $sala->tipo }}'/>

            <flux:select label="Sucursal" wire:model='sucursal_id'>
                <option value="">Seleccione una sucursal</option>
                @foreach($sucursales as $sucursal)
                    <option value="{{ $sucursal->id }}" {{ $sala->sucursal_id == $sucursal->id ? 'selected' : '' }}>
                        {{ $sucursal->nombre }}
                    </option>
                @endforeach
            </flux:select>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Guardar</flux:button>
            </div>
        </form>
    </div>

    
</x-layouts.app>
