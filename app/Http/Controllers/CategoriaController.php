<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; 

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json(['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:100', 
        ]);

        $categoria = Categoria::create([
            'nome' => $request->input('nome'),
        ]);

        return response()->json(['categoria' => $categoria], 201); 
    }

    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada'], 404); 
        }

        return response()->json(['categoria' => $categoria]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:100', 
        ]);

        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada'], 404); 
        }

        $categoria->update([
            'nome' => $request->input('nome'),
        ]);

        return response()->json(['categoria' => $categoria]);
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['message' => 'Categoria não encontrada'], 404); 
        }

        $categoria->delete();

        return response()->json(['message' => 'Categoria excluída']);
    }
}

