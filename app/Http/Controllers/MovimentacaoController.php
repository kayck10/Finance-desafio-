<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MovimentacaoController extends Controller
{

    public function dashboard()
    {
        return view('auth.dashboard.index');
    }

    public function create()
    {
        return view('movimentacoes.create');
    }

    public function index(Request $request)
    {
        $query = Movimentacao::query();

        if ($request->has('tipo')) {
            $query->where('tipo_id', $request->tipo);
        }

        if ($request->has('ordem') && $request->has('campo')) {
            $query->orderBy($request->campo, $request->ordem);
        }

        $movimentacoes = $query->with(['categoria', 'tipo'])->get();

        return response()->json($movimentacoes);
    }


    public function store(Request $request)
    {

        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $movimentacao = Movimentacao::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
            'data' => $request->data,
            'categoria_id' => $request->categoria_id,
            'tipo_id' => $request->tipo_id,
        ]);

        return redirect()->route('movimentacoes.index')->with('success', 'Movimentação criada com sucesso!');
    }

    public function show(Movimentacao $movimentacao)
    {
        return response()->json($movimentacao);
    }

    public function update(Request $request, Movimentacao $movimentacao)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'data' => 'required|date',
        ]);

        $movimentacao->update($request->all());
        return response()->json($movimentacao);
    }

    public function destroy(Movimentacao $movimentacao)
    {
        $movimentacao->delete();
        return response()->json(['message' => 'Movimentação excluída com sucesso']);
    }
}
