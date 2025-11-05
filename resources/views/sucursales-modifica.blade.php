<x-layouts.app>

    <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Modifica sucursales</flux:heading>
                    <flux:text class="mt-2">Modifica los detalles de las sucursales.</flux:text>
                </div>

                <form METHOD='POST' action='{{ route('sucursales.update',$sucursal->id)}}'>
                    @csrf
                    <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre' value='{{$sucursal->nombre}}'/>
                    <flux:input label="Direccion" placeholder="Direccion" wire:model='direccion' value='{{$sucursal->direccion}}'/>

                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Guardar</flux:button>
                    </div>
                </form>
    </div>  
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
                        <form method='POST' action={{ route('salas.delete',$sala->id) }}>
                            @csrf
                            <flux:button type="submit">Eliminar</flux:button>
                        </form>
                        <flux:brand href="{{route('salas.show',$sala->id)}}" name="Modificar">
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
                    <flux:heading size="lg">Agregar salas</flux:heading>
                    <flux:text class="mt-2">Agrega todos los detalles de las salas.</flux:text>
                </div>              
                <form method='POST' action='{{ route('salas.store') }}'>
                    @csrf
                    <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre'/>
                    <flux:input label="Capacidad" placeholder="Capacidad" wire:model='capacidad'/>
                    <flux:select label="Sucursal" wire:model='sucursal_id'>
                        <option value="">Seleccione una sucursal</option>
                        @foreach($sucursales as $sucursal)
                            <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
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