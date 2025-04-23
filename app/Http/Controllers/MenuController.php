<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function listaCategorias()
    {
        $categorias = DB::table('categorias') 
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        return view('Categorias.index', compact('categorias'));
    }

    public function vistaCrearCategorias()
    {
        return view('Categorias.create');
    }
  
    public function crearCategorias(Request $request)
    {
       
        DB::table('Categorias')->insert([
            'nombre' => $request->input('nombre_categoria'),
            'descripcion' => $request->input('descripcion_categoria'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        return redirect('vista-categorias')->with('success', 'Categoria creada con éxito.');
    }

    public function editarCategoria($id)
    {
        $categorias = DB::table('categorias')->where('id', $id)->first();
        
        if (!$categorias) {
            return redirect('vista-categorias')->with('error', 'Categoria no encontrada');
        }
        
        return view('Categorias.editar', compact('categorias'));
    }
    
    public function actualizarCategoria(Request $request, $id)
    {
        $request->validate([
            'Nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);
        
        $hamburguesa = DB::table('categorias')->where('id', $id)->first();
        
        if (!$hamburguesa) {
            return redirect('vista-categorias')->with('error', 'Hamburguesa no encontrada');
        }
        
        $datosActualizar = [
            'Nombre' => $request->Nombre,
            'descripcion' => $request->descripcion,
            'updated_at' => now(),
        ];
        
        DB::table('Categorias')
            ->where('id', $id)
            ->update($datosActualizar);
        
        return redirect('vista-categorias')->with('success', 'Categoria actualizada exitosamente');
    }
    
    public function eliminarCategoria($id)
    {
        DB::table('categorias')->where('id', $id)->delete();
        
        return redirect('vista-categorias')->with('success', 'Categoria eliminada exitosamente');
    }
}