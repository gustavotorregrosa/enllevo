<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipamento;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('jwt');
    }


    public function index()
    {
        $itens = Equipamento::all();
        return respostaCors($itens, 200);
    }

    public function salvar(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
           return $this->update($request, $id);
        } else {
            return $this->create($request);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
        $equipamento = new Equipamento;
        $equipamento->nome = $request->input('nome');
        $equipamento->descricao = $request->input('descricao');
        $equipamento->valor = $request->input('valor');
        $equipamento->quantidade = $request->input('quantidade');

        try {
            $equipamento->save();
            return respostaCors("Equipamento " . $equipamento->nome . " criado", 200);
        } catch (Exception $e) {
            return respostaCors($e->getMessage(), 501);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipamento = Equipamento::find($id);
        $equipamento->nome = $request->input('nome');
        $equipamento->descricao = $request->input('descricao');
        $equipamento->valor = $request->input('valor');
        $equipamento->quantidade = $request->input('quantidade');

        try {
            $equipamento->save();
            return respostaCors("Equipamento " . $equipamento->nome . " modificado", 200);
        } catch (Exception $e) {
            return respostaCors($e->getMessage(), 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $equipamento = Equipamento::find($id);
            $nome = $equipamento->nome;
            $equipamento->delete();
            return respostaCors("Equipamento " . $nome . " deletado", 200);
        } catch (Exception $e) {
            return respostaCors($e->getMessage(), 501);
        }
        
    }
}
