<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::paginate(3);
        foreach ($produtos as $produto) {
            $produto->imagem = basename(Storage::url($produto->imagem));
        }

        return response()->json($produtos);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $result = Produto::where('nome', 'like', '%' . $query . '%')
            ->orWhere('descricao', 'like', '%' . $query . '%')
            ->paginate(3);

        return response()->json([
            'data' => $result->items(),
            'current_page' => $result->currentPage(),
            'per_page' => $result->perPage(),
            'total' => $result->total(),
        ]);
    }



    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($produto);
    }

    public function store(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            $foto = $request->file('imagem');
            $nome = $foto->hashName();
            $foto->move('fotos', $nome);
            $data['imagem'] = $nome;
        }

        $preco = str_replace(',', '.', $request->input('preco'));

        $data['preco'] = $preco;

        $produto = Produto::create($data);

        return response()->json($produto, 201);
    }



    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $data = $request->all();

        if ($request->hasFile('imagem')) {
            Storage::delete('fotos/' . $produto->imagem);

            $foto = $request->file('imagem');
            $nome = $foto->hashName();
            $foto->move('fotos', $nome);
            $data['imagem'] = $nome;
        }

        $preco = str_replace(',', '.', $request->input('preco'));

        $data['preco'] = $preco;

        $produto->update($data);

        return response()->json($produto, 200);
    }


    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        Storage::delete('fotos/' . $produto->imagem);

        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso'], 200);
    }

}


