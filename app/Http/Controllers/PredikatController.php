<?php

namespace App\Http\Controllers;

use App\Models\Predikat;
use Illuminate\Http\Request;

class PredikatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $predikat = Predikat::orderBy('normatif', 'DESC')->orderBy('produktif', 'DESC')->get();
        return view('admin.predikat.index', compact('predikat'));
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
        $predikat = Predikat::find($id);
        return view('admin.predikat.edit', compact('predikat'));
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
        $this->validate($request, [
            'predikat' => 'required',
            'normatif' => 'required',
            'produktif' => 'required'
        ]);

        $predikat = Predikat::find($id);
        $predikat->update([
            'predikat' => $request->predikat,
            'normatif' => $request->normatif,
            'produktif' => $request->produktif
        ]);

        return redirect()->route('predikat.index')->with('success', 'Predikat berhasil diperbarui!');
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
