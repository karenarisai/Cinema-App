<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Sala;
use App\Models\Pelicula;

class adminController extends Controller
{
    public function index(){
        $sucursales=Sucursal::all();
        return view('sucursales',compact('sucursales'));
    }

    public function save(Request $request){
        $sucursal=new Sucursal();
        $sucursal->nombre=$request->nombre;
        $sucursal->direccion=$request->direccion;
        $sucursal->telefono=$request->telefono;
        $sucursal->director=$request->director;
        $sucursal->save();
        return redirect()->back();
    }

    public function delete($id){
        $sucursal=Sucursal::find($id);
        $sucursal->delete();
        return redirect()->back();
    }

    public function deletePelicula($id){
        $pelicula=Pelicula::find($id);
        $pelicula->delete();
        return redirect()->back();
    }

    public function show($id){
        $sucursal=sucursal::find($id);
        return view('sucursales-modifica',compact('sucursal'));
    }

    public function showPelicula($id){
        $pelicula=Pelicula::find($id);
        return view('peliculas-modifica',compact('pelicula'));
    }
    
    public function update(Request $request,$id){
        $sucursal=sucursal::find($id);
        $sucursal->nombre=$request->nombre;
        $sucursal->direccion=$request->direccion;
        $sucursal->telefono=$request->telefono;
        $sucursal->director=$request->director;
        $sucursal->save();
        return redirect()->route('sucursales.index');
    }

    public function updatePeliculas(Request $request,$id){
        $pelicula=Pelicula::find($id);
        $pelicula->nombre=$request->nombre;
        $pelicula->director=$request->director;
        $pelicula->duracion=$request->duracion;
        $pelicula->genero=$request->genero;
        $pelicula->save();
        return redirect()->route('peliculas.index');
    }

    public function indexSalas(){
        $sucursales=Sucursal::all();
        $salas=sala::all();
        return view('salas',compact(['sucursales','salas']));
    }

    public function indexPeliculas(){
        $peliculas=Pelicula::all();
        return view('peliculas',compact(['peliculas']));
    }

    public function saveSalas(Request $request){
        $sala=new Sala();
        $sala->nombre=$request->nombre;
        $sala->capacidad=$request->capacidad;
        $sala->sucursal_id=$request->sucursal_id;
        $sala->save();
        return redirect()->back();
    }

    public function savePeliculas(Request $request){
        $pelicula=new Pelicula();
        $pelicula->nombre=$request->nombre;
        $pelicula->director=$request->director;
        $pelicula->genero=$request->genero;
        $pelicula->duracion=$request->duracion;
        $pelicula->save();
        return redirect()->back();
    }
}
