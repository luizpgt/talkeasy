<?php

namespace App\Http\Controllers;

use App\SugestaoModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SugestaoController extends Controller
{
    public function index()
    {
        //$ObjSugestao = DB::table('sugestoes')->paginate(10);
        //dd($ObjSugestao);
        //$ObjSugestao = SugestaoModel::orderBy('id')->get();
        $ObjSugestao = SugestaoModel::orderBy('id')->paginate(10);
        //dd($ObjSugestao);
        return view('pSugestoes')->with('sugestao', $ObjSugestao);
    }

    public function store(Request $request)
    {

        $request->validate([
            'usuario_id' => 'required',
            'sugestao' => 'required|max:255',
        ]);
        $ObjSugestao = new SugestaoModel();
        $ObjSugestao->usuario_id = $request->usuario_id;
        $ObjSugestao->sugestao = $request->sugestao;
        $ObjSugestao->save();
        return redirect()->back()->withInput()->withErrors(['Sugestão inserida com sucesso!']);
    }
}
