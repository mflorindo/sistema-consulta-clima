<?php

namespace App\Http\Controllers;

use App\Cidade;
use App\PrevisaoClima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClimaController extends Controller
{

    protected $data =  '2021-02-04';
    public function inicializacao()
    {

        $dados['maximas'] = DB::table('previsao_clima')
            ->select('previsao_clima.temperatura_maxima', 'cidade.nome', 'estado.uf')
            ->join('cidade', 'cidade.id', '=', 'previsao_clima.cidade_id')
            ->join('estado', 'estado.id', '=', 'cidade.estado_id')
            ->where('data_previsao', $this->data)
            ->orderBy('temperatura_maxima', 'desc')
            ->take(3)->get();

        $dados['minimas'] = DB::table('previsao_clima')
            ->select('previsao_clima.temperatura_maxima', 'cidade.nome', 'estado.uf')
            ->join('cidade', 'cidade.id', '=', 'previsao_clima.cidade_id')
            ->join('estado', 'estado.id', '=', 'cidade.estado_id')
            ->where('data_previsao', $this->data)
            ->orderBy('temperatura_minima')
            ->take(3)->get();

        return response()->json($dados, 200);
    }

    public function obterCidades(Request $request)
    {
        DB::enableQueryLog();
        $lista = DB::table('cidade')
            ->select('cidade.id', 'cidade.nome', 'estado.uf')
            ->join('estado', 'estado.id', '=', 'cidade.estado_id')
            ->where('cidade.nome', 'like', '%' . $request['termo'] . '%')
            ->orderBy('cidade.nome')->get();

        return response()->json($lista, 200);
    }

    public function obterPrevisao($cidade)
    {
        $lista = PrevisaoClima::select('data_previsao', 'clima', 'temperatura_maxima', 'temperatura_minima')
            ->where('cidade_id', $cidade)
            ->where('data_previsao', '>=', $this->data)
            ->orderBy('data_previsao')
            ->take(7)
            ->get();
        return response()->json($lista, 200);
    }
}
