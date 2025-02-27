<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function listaHamburguesas()
    {
        return view('menu.hamburguesas.index');
    }
    public function vistaCrearHamburguesas()
    {
        return view('menu.hamburguesas.create');
    }
    public function craerHamburguesa(Request $request){
        // dd('aaaa');
        dd($request->all());
        $nombrehamburguesa = $request->input('nombre_hamburguesa');
        $descripcion = $request->input('descripcion_hamburguesa');
        $precio = $request->input('precio_hamburguesa');
        $disponibilidad = $request->input('disponibilidad');
        $imagen = $request->input('imagen');

        $nombreHamburguesa = Str::slug($request->input('nombre_hamburguesa'), '-');

        // Subir la imagen con el nombre formateado en la carpeta hamburguesas
        if ($request->hasFile('imagen')) {
            $extension = $request->file('imagen')->getClientOriginalExtension();
            $fileName = $nombreHamburguesa . '.' . $extension; // ejemplo: big-mac.jpg
            $path = $request->file('imagen')->storeAs('public/hamburguesas', $fileName);
        } else {
            $fileName = null;
        }

        // Guardar en la base de datos
        DB::table('hamburguesas')->insert([
            'nombre' => $request->input('nombre_hamburguesa'),
            'descripcion' => $request->input('descripcion_hamburguesa'),
            'precio' => $request->input('precio_hamburguesa'),
            'disponibilidad' => $request->input('disponibilidad'),
            'imagen' => $fileName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Hamburguesa creada con éxito.');
    }
}

