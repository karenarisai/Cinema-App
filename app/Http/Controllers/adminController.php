<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Sala;
use App\Models\Pelicula;
use App\Models\Funcion;
use Dompdf\Dompdf;

class adminController extends Controller
{
    public function dashboard()
    {
        $salas = Sala::all();
        $sucursales = Sucursal::all();
        return view('dashboard', compact('salas', 'sucursales'));
    }

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
        $salas=Sala::all();
        
        return view('sucursales-modifica',compact('sucursal','salas'));
    }

    public function showPelicula($id){
        $pelicula=Pelicula::find($id);
        $salas=Sala::all();
        $sucursales=Sucursal::all();
        return view('peliculas-modifica',compact('pelicula','salas','sucursales'));
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
        $salas=Sala::all();
        return view('salas',compact(['sucursales','salas']));
    }

    public function indexPeliculas(){
        $peliculas=Pelicula::all();
        return view('peliculas',compact(['peliculas']));
    }

    public function showSalas($id){
        $sala = Sala::find($id);
        $sucursales =Sucursal::all();
        return view('salas-modifica',compact('sala','sucursales'));
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

    public function deleteSalas($id){
        $sala=Sala::find($id);
        $sala->delete();
        return redirect()->back();
    }
   
    public function updateSalas(Request $request,$id){
        $sala=Sala::find($id);
        $sala->nombre=$request->nombre;
        $sala->capacidad=$request->capacidad;
        $sala->sucursal_id=$request->sucursal_id;
        $sala->save();
        return redirect()->route('salas.index');
    }
    
    public function indexFunciones(){
        $salas=Sala::all();
        $peliculas=Pelicula::all();
        $funciones=Funcion::all();
        return view('funciones',compact(['salas','peliculas','funciones']));
    }

    public function saveFunciones(Request $request)
{
    $funcion = new Funcion();
    $funcion->sala_id = $request->sala_id;
    $funcion->pelicula_id = $request->pelicula_id;
    $funcion->fecha = $request->fecha;
    $funcion->tipo = $request->tipo;
    $funcion->costo = $request->costo;
    $funcion->save();
    return redirect()->back();
}

public function deleteFunciones($id){
    $funcion = Funcion::find($id);
    $funcion->delete();
    return redirect()->back();

}
    public function showFunciones($id){
        $funcion=Funcion::find($id);
        $peliculas = Pelicula::all();
        $salas = Sala::all();
        return view('funciones-modifica',compact('funcion','peliculas','salas'));
    }
   
   public function updateFunciones(Request $request,$id){
    $funcion = Funcion::find($id);
    $funcion->pelicula_id = $request->pelicula_id;
    $funcion->sala_id = $request->sala_id;
    $funcion->fecha = $request->fecha ?? $request->fecha_hora; 
    $funcion->tipo = $request->tipo;
    $funcion->costo = $request->costo;
    $funcion->save();

    return redirect()->route('funciones.index');
    }

    public function edit($id)
    {
        $funcion = Funcion::find($id);
        $peliculas = Pelicula::all();
        $salas = Sala::all();
        return view('funciones-modifica', compact('funcion', 'peliculas', 'salas'));
    }

    public function generarReportePeliculasSalas(REQUEST $request)
    {
        $dompdf = new Dompdf();
        $salas = Sala::find($request->salas);
        $funciones = Funcion::where('sala_id', $request->salas)->get();
        $peliculas = Pelicula::all();
        //dd($request->salas);
        $html = view('reportesPeliculasSalas', compact('salas', 'funciones', 'peliculas'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('reporte_peliculas_salas.pdf', ['Attachment' => true]);
        
    }

}
