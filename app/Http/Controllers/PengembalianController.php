<?php

namespace App\Http\Controllers;

use App\Pengembalian;
use Illuminate\Http\Request;
use PDF;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengembalians = Pengembalian::all();
        return view('pengembalian.index', compact('pengembalians'));
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
     * @param  \App\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengembalian  $pengembalian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengembalian $pengembalian)
    {
        //
    }

    // public function pdf($id)
    // {
    //     $struk = pengembalian::findOrFail($id);
    //     // $size = Size::where('id', $struk->size_id)->first();
    //     $pdf = PDF::loadView('pengembalian.pdf', compact('struk'));
    //     $pdf->setPaper('a4', 'potrait');
    //     return $pdf->stream();
    // }
    public function laporan1(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $pengembalians = pengembalian::whereBetween('tanggal_kembali', [$dari, $sampai])->get();
        return view('pengembalian.filter', compact('pengembalians', 'dari', 'sampai'));
    }
    public function laporan2(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $pengembalians = pengembalian::whereBetween('tanggal_kembali', [$dari, $sampai])->get();
        $pdf = PDF::loadView('pengembalian/pdf', compact('pengembalians', 'dari', 'sampai'));
        // return $pdf->download('Laporan Pengembalian.pdf');
        return $pdf->stream();
    }
    // public function laporan3(Request $request)
    // {

    //     $pengembalians = pengembalian::whereBetween('konsumen_id')->get();
    //     $pdf = PDF::loadView('laporan/pdf', compact('pengembalians'));
    //     return $pdf->stream();
    //     // return $pdf->download('Laporan Pengembalian.pdf');
    // }
}
