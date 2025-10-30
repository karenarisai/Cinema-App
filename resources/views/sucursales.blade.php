<x-layouts.app>
    <h2>Sucursales</h2>
    <div>
        <flux:modal.trigger name="edit-profile">
            <flux:button>Agregar sucursal</flux:button>
        </flux:modal.trigger>
    </div>
    <div class="mt-2">
        <table class="w-full border border-black">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Director</th>
                <th>Acciones</th>
            </thead>
            <tbody class="text-center">
                @foreach($sucursales as $sucursal)
                <tr class="border border-b-black py-2">
                    <td>{{$sucursal->id}}</td>
                    <td>{{$sucursal->nombre}}</td>
                    <td>{{$sucursal->direccion}}</td>
                    <td>{{$sucursal->telefono}}</td>
                    <td>{{$sucursal->director}}</td>
                    <td class="flex items-center justify-around">
                        <form method='POST' action={{ route('sucursales.delete',$sucursal->id) }}>
                            @csrf
                            <flux:button type="submit">Eliminar</flux:button>
                        </form>
                        <flux:brand href="{{route('sucursales.show',$sucursal->id)}}" name="Modificar">
                         </flux:brand>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

     <flux:modal name="edit-profile" class="md:w-96">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Agregar sucursales</flux:heading>
                    <flux:text class="mt-2">Agrega todos los detalles de las sucursales.</flux:text>
                </div>

                <form METHOD='POST' action="{{ route('sucursales.save') }}">
                    @csrf
                    <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre' />
                    <flux:input label="Dirección" placeholder="Dirección" wire:model='direccion' />
                    <flux:input label="Telefono" placeholder="Telefono" wire:model='telefono' />
                    <flux:input label="Director" placeholder="Director" wire:model='director' />

                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Guardar</flux:button>
                    </div>
                </form>
            </div>
    </flux:modal>
</x-layouts.app>

