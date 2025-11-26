<x-layouts.app>
    <h2>Peliculas</h2>
    <div>
        <flux:modal.trigger name="edit-profile">
            <flux:button>Agregar peliculas</flux:button>
        </flux:modal.trigger>
    </div>

   

    <form method='POST' action='{{ route("peliculas.importar") }}' enctype='multipart/form-data' class="space-y-4">
					@csrf
					<div>
						<flux:input 
							type='file' 
							name='archivo' 
							label="Archivo Excel"
							accept=".xlsx,.xls,.csv"
							required
						/>
					</div>
					<div class="flex items-center justify-end gap-3">
						<flux:button type='submit' variant='primary' icon='arrow-up-tray'>
							Importar Películas
						</flux:button>
					</div>
				</form>
    

    <div class="mt-2">
        <table class="w-full border border-black">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Director</th>
                <th>Duración</th>
                <th>Genero</th>
                <th>Acciones</th>
            </thead>
            <tbody class="text-center">
                @foreach($peliculas as $pelicula)
                <tr class="border border-b-black py-2">
                    <td>{{$pelicula->id}}</td>
                    <td>{{$pelicula->nombre}}</td>
                    <td>{{$pelicula->director}}</td>
                    <td>{{$pelicula->duracion}}</td>
                    <td>{{$pelicula->genero}}</td>
                    <td class="flex items-center justify-around">
                        <form method='POST' action={{ route('peliculas.delete',$pelicula->id) }}>
                            @csrf
                            <flux:button type="submit">Eliminar</flux:button>
                        </form>
                        <flux:brand href="{{route('peliculas.show',$pelicula->id)}}" name="Modificar">
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
                    <flux:heading size="lg">Agregar peliculas</flux:heading>
                    <flux:text class="mt-2">Agrega todos los detalles de las peliculas.</flux:text>
                </div>

                <form METHOD='POST' action="{{ route('peliculas.save') }}">
                    @csrf
                    <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre' />
                    <flux:input label="Director" placeholder="Director" wire:model='director' />
                    <flux:input label="Duración" placeholder="Duración" wire:model='duracion' />
                    <flux:input label="Genero" placeholder="Genero" wire:model='genero' />

                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Guardar</flux:button>
                    </div>
                </form>
            </div>
    </flux:modal>
</x-layouts.app>