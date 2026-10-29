<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Leer todos los productos — GET
    public function index(Request $request)
    {
        $productos = $request->session()->get('productos', []);
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario de crear — GET
    public function create()
    {
        return view('productos.create');
    }

    // Guardar producto nuevo — POST
    public function store(Request $request)
    {
        $validados = $request->validate([
            'nombre'  => 'required|string|max:100',
            'precio'  => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
        ]);

        $productos = $request->session()->get('productos', []);
        $nuevoId = count($productos) > 0 ? max(array_column($productos, 'id')) + 1 : 1;

        $validados['id'] = $nuevoId;
        $productos[] = $validados;
        $request->session()->put('productos', $productos);

        return redirect()->route('productos.index')->with('ok', 'Producto creado correctamente ✅');
    }

    // Mostrar formulario de editar — GET
    public function edit($id, Request $request)
    {
        $productos = $request->session()->get('productos', []);
        $producto = collect($productos)->firstWhere('id', $id);

        abort_if(!$producto, 404);
        return view('productos.edit', compact('producto'));
    }

    // Actualizar producto — PUT
    public function update(Request $request, $id)
    {
        $validados = $request->validate([
            'nombre'  => 'required|string|max:100',
            'precio'  => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
        ]);

        $productos = $request->session()->get('productos', []);

        foreach ($productos as &$prod) {
            if ($prod['id'] == $id) {
                $prod['nombre'] = $validados['nombre'];
                $prod['precio'] = $validados['precio'];
                $prod['cantidad'] = $validados['cantidad'];
                break;
            }
        }

        $request->session()->put('productos', $productos);
        return redirect()->route('productos.index')->with('ok', 'Producto actualizado ✅');
    }

    // Eliminar producto — DELETE
    public function destroy($id, Request $request)
    {
        $productos = $request->session()->get('productos', []);
        $productos = array_filter($productos, fn($p) => $p['id'] != $id);

        $request->session()->put('productos', $productos);
        return redirect()->route('productos.index')->with('ok', 'Producto eliminado ✅');
    }
}
