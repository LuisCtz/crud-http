@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-list-ul"></i> Lista de Productos</h2>
        <a href="{{ route('productos.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </a>
    </div>

    @if(count($productos) > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $prod)
                        <tr>
                            <td>{{ $prod['id'] }}</td>
                            <td>{{ $prod['nombre'] }}</td>
                            <td>$ {{ number_format($prod['precio'], 2) }}</td>
                            <td>{{ $prod['cantidad'] }}</td>
                            <td>
                                <a href="{{ route('productos.edit', $prod['id']) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('productos.destroy', $prod['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center py-4">
            <i class="bi bi-info-circle fs-3"></i>
            <p class="mt-2 fs-5">No hay productos registrados</p>
            <a href="{{ route('productos.create') }}" class="btn btn-primary mt-2">
                <i class="bi bi-plus-lg"></i> Agregar el primero
            </a>
        </div>
    @endif
@endsection