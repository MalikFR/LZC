<?php

namespace App\Http\Controllers;

use App\Konsumen;
use Illuminate\Http\Request;
use App\Traits\SessionFlash;
use Alert;


class KonsumenController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $konsumens = Konsumen::all();
        return view('konsumen.index', compact('konsumens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konsumen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Alert::success('Data Successfully Saved', 'Good Job!')->autoclose(1500);
        $this->validate($request, [
            'nik' => 'required|unique:konsumens',
            'nama' => 'required|',
            'nohp' => 'required|unique:konsumens',
            'alamat' => 'required|'
        ]);
        $konsumens = new Konsumen;
        $konsumens->nik = $request->nik;
        $konsumens->nama = $request->nama;
        $konsumens->nohp = $request->nohp;
        $konsumens->alamat = $request->alamat;
        $konsumens->save();
        return redirect()->route('konsumen.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $konsumens = Konsumen::findorFail($id);
        return view('konsumen.edit', compact('konsumens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Alert::success('Data Successfully Changed', 'Good Job!')->autoclose(1500);
        $this->validate($request, [
            'nik' => 'required|unique:konsumens',
            'nama' => 'required|',
            'nohp' => 'required|unique;konsumens',
            'alamat' => 'required|'
        ]);
        $konsumens = Konsumen::find($id);
        $konsumens->nik = $request->nik;
        $konsumens->nama = $request->nama;
        $konsumens->nohp = $request->nohp;
        $konsumens->alamat = $request->alamat;
        $konsumens->save();
        return redirect()->route('konsumen.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alert::success('Data Successfully Deleted', 'Good Job!')->autoclose(1500);
        $konsumens = Konsumen::findOrFail($id);
        $konsumens->delete();

        return redirect()->route('konsumen.index');
    }
}
