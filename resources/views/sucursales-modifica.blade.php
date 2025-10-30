<x-layouts.app>
    <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Agregar sucursales</flux:heading>
                    <flux:text class="mt-2">Agrega todos los detalles de las sucursales.</flux:text>
                </div>

                <form METHOD='POST' action='{{ route('sucursales.update',$sucursal->id)}}'>
                    @csrf
                    <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre' value='{{$sucursal->nombre}}'/>
                    <flux:input label="Dirección" placeholder="Dirección" wire:model='direccion' value='{{$sucursal->direccion}}' />
                    <flux:input label="Telefono" placeholder="Telefono" wire:model='telefono' value='{{$sucursal->telefono}}'/>
                    <flux:input label="Director" placeholder="Director" wire:model='director' value='{{$sucursal->director}}'/>

                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Guardar</flux:button>
                    </div>
                </form>
    </div>
</x-layouts.app>