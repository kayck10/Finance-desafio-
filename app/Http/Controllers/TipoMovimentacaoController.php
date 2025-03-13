<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimentacao;

class TipoMovimentacaoController extends Controller
{
    public function index()
{
    return response()->json(TipoMovimentacao::all(), 200);
}

}
