<?php

namespace App\Http\Controllers;

use App\LikeModel;
use App\QTDLikeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$ObjLikes = LikeModel::orderBy('created_at')->get();
        $ObjQTDLikes = QTDLikeModel::orderBy('sugestao_id')->get();
        return view('controlPanel.listLikes')->with('qtd_likes', $ObjQTDLikes);
        //return view('likes.list')->with(['likes' => $ObjLikes, 'qtd_likes' => $ObjQTDLikes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (DB::table('likes')->where(['usuario_id' => $request->usuario_id, 'sugestao_id' => $request->sugestao_id])->count() == 0) {
            $request->validate([
                'usuario_id' => 'required',
                'sugestao_id' => 'required',
            ]);
            $ObjLikes = new LikeModel();
            $ObjLikes->usuario_id = $request->usuario_id;
            $ObjLikes->sugestao_id = $request->sugestao_id;
            $ObjLikes->save();
            return redirect()->back()->withInput()->withErrors(['Você gostou de uma Palavra!']);
        } else{
            return redirect()->back()->withInput()->withErrors(['Você já gostou dessa Palavra!']);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
