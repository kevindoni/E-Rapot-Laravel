<?php

namespace App\Http\Controllers;

use App\Models\Ekstra;
use App\Models\NilaiEkstra;
use Illuminate\Http\Request;

class EkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ekstra.index');
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
        $this->validate($request, [
            'nama_ekstra' => 'required'
        ]);

        Ekstra::updateOrCreate(
            [
                'id' => $request->ekstra_id
            ],
            [
                'nama_ekstra' => $request->nama_ekstra
            ]
        );

        if ($request->ekstra_id) {
            return redirect()->route('ekstra.index')->with('success', 'Data ekstra berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'Data ekstra berhasil ditambahkan!');
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
        $ekstra = Ekstra::find($id);
        return view('admin.ekstra.edit', compact('ekstra'));
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
        NilaiEkstra::where('ekstra_id', $id)->delete();
        Ekstra::find($id)->delete();
        return redirect()->back()->with('success', 'Data ekstra berhasil dihapus!');
    }
}
