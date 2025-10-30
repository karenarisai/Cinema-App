<x-layouts.app>
    <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Modifica peliculas</flux:heading>
                    <flux:text class="mt-2">Modifica los detalles de las peliculas.</flux:text>
                </div>

                <form METHOD='POST' action='{{ route('peliculas.update',$pelicula->id)}}'>
                    @csrf
                    <flux:input label="Nombre" placeholder="Nombre" wire:model='nombre' value='{{$pelicula->nombre}}'/>
                    <flux:input label="Genero" placeholder="Genero" wire:model='genero' value='{{$pelicula->genero}}' />
                    <flux:input label="Duracion" placeholder="Duracion" wire:model='duracion' value='{{$pelicula->duracion}}'/>
                    <flux:input label="Director" placeholder="Director" wire:model='director' value='{{$pelicula->director}}'/>

                    <div class="flex">
                        <flux:spacer />

                        <flux:button type="submit" variant="primary">Guardar</flux:button>
                    </div>
                </form>
    </div>
</x-layouts.app>