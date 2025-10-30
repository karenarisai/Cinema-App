<x-layouts.app>
    <div>
        <flux:modal.trigger name="edit-profile">
            <flux:button>Agregar salas</flux:button>
        </flux:modal.trigger>

        <div class="mt-2">
        <table class="w-full border border-black">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Capacidad</th>
                <th>Sucursal</th>
                <th>Acciones</th>
            </thead>
            <tbody class="text-center">
                @foreach($salas as $sala)
                <tr class="border border-b-black py-2">
                    <td>{{$sala->id}}</td>
                    <td>{{$sala->nombre}}</td>
                    <td>{{$sala->capacidad}}</td>
                    @foreach ($sucursales as $sucursal)
                        @if ($sala->sucursal_id == $sucursal->id)
                            <td>{{$sucursal->nombre}}</td>
                        @endif
                    @endforeach
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
    </div>
    <flux:modal name="edit-profile" class="md:w-96">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Agregar salas</flux:heading>
                    <flux:text class="mt-2">Agrega todos los detalles de las salas.</flux:text>
                </div>

                <form METHOD='POST' action="{{ route('salas.save') }}">
                    @csrf
                    <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre' />
                    <flux:input label="Capacidad" placeholder="capacidad" wire:model='capacidad' type="number" />
                    <flux:select wire:model="sucursal_id" label="sucursal" placeholder="Selecciona sucursal">
                        @foreach($sucursales as $sucursal)
                        <flux:select.option value='{{ $sucursal->id }}'>{{ $sucursal->nombre }}</flux:select.option>
                        @endforeach
                    </flux:select>
                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Guardar</flux:button>
                    </div>
                </form>
            </div>
    </flux:modal>
</x-layouts.app>