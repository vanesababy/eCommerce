<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductosController extends Controller
{
    public function listaProductos()
    {
        $productos = DB::table('Productos')
        ->join('categorias', 'Productos.id_categoria', '=', 'categorias.id')
        ->select('Productos.*', 'categorias.nombre as categoria_nombre')
        ->orderBy('Productos.id', 'desc')
        ->paginate(10);
        
        return view('Productos.index', compact('productos'));
    }

    public function vistaCrearProductos()
    {
        $categorias = DB::table('categorias')->get();
        return view('Productos.create' , compact('categorias'));
    }
  
    public function craerProductos(Request $request)
    {
        $nombreProductos = Str::slug($request->input('nombre_Productos'), '-');
    
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreProductos = Str::slug($request->input('nombre_Productos'), '-');
            $fileName = $nombreProductos . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Productos', $fileName, 'public');
            $fileName = 'Productos/' . $fileName;
        } else {
            $fileName = null;
        }

        DB::table('Productos')->insert([
            'nombre' => $request->input('nombre_producto'),
            'descripcion' => $request->input('descripcion_producto'),
            'precio' => $request->input('precio_producto'),
            'disponible' => $request->input('disponibilidad'),
            'imagen' => $fileName,
            'id_categoria' => $request->input('id_categoria'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        return redirect('vista-productos')->with('success', 'Productos creada con éxito.');
    }

    public function editarProducto($id)
    {
        $producto = DB::table('productos')->where('productos.id', $id)
        ->join('categorias', 'Productos.id_categoria', '=', 'categorias.id')
        ->select('Productos.*', 'categorias.nombre as categoria_nombre')
        ->first();


        $categorias =DB::table('categorias')
        ->get();

        if (!$producto) {
            return redirect('vista-productos')->with('error', 'Productos no encontrada');
        }
        
        return view('Productos.editar', compact('producto','categorias'));
    }
    
    public function actualizarProducto(Request $request, $id)
    {
        $producto = DB::table('Productos')->where('id', $id)->first();
    
        if (!$producto) {
            return redirect('vista-productos')->with('error', 'Producto no encontrado');
        }
    
        $datosActualizar = [
            'nombre' => $request->Nombre, 
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'disponible' => $request->disponible,
            'id_categoria' => $request->id_categoria,
            'updated_at' => now(),
        ];
        // dd($datosActualizar);
    
        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
    
            $imagen = $request->file('imagen');
            $imagenNombre = time() . '_' . $imagen->getClientOriginalName();
            $imagenPath = $imagen->storeAs('Productos', $imagenNombre, 'public');
            $datosActualizar['imagen'] = $imagenPath;
        }
    
        DB::table('Productos')->where('id', $id)->update($datosActualizar);
    
        return redirect('vista-productos')->with('success', 'Producto actualizado exitosamente');
    }
    
    public function eliminarProductos($id)
    {
        DB::table('Productos')->where('id', $id)->delete();
        
        return redirect('vista-productos')->with('success', 'Productos eliminada exitosamente');
    }
}
