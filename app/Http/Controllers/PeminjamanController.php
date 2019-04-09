<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
use App\Konsumen;
use App\Barang;
use App\Pengembalian;
use DateTime;
use Alert;

class PeminjamanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjamans = Peminjaman::all();
        return view('peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $konsumens = Konsumen::all();
        $barangs = Barang::all();
        return view('peminjaman/create', compact('konsumens', 'barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        for ($id = 0; $id < count($request->barang_id); $id++) {
            $barang = Barang::findOrFail($request->barang_id[$id]);
            if ($barang->stock < $request->jumlah_pinjam[$id]) {
                Alert::Warning(" Maaf, " . $barang->nama . " Yang Akan Di Pinjam Hanya Tersisa " . $barang->stock)->autoclose(5000);
            } else {
                $peminjamans = new Peminjaman;
                $peminjamans->konsumen_id = $request->konsumen_id;
                $peminjamans->barang_id = $request->barang_id[$id];
                Alert::Warning(" Maaf, " . $barang->nama . " Yang Akan Di Pinjam Hanya Tersisa " . $barang->stock)->autoclose(5000);
                $peminjamans->jumlah_pinjam = $request->jumlah_pinjam[$id];
                $peminjamans->tanggal_batas = $request->tanggal_batas[$id];
                $peminjamans->save();
                $barang->stock = $barang->stock - $request->jumlah_pinjam[$id];
                $barang->save();
                Alert::success(" Berhasil, Meminjam " . $barang->nama . " Dengan Jumlah " . $request->jumlah_pinjam[$id])->autoclose(5000);
            }
        }

        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjamanss
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjamans = Peminjaman::findOrFail($id);
        $konsumens = Konsumen::all();
        $barangs = Barang::all();
        $selectedKonsumen = Peminjaman::findOrFail($id)->id_konsumen;
        $selectedBarang = Peminjaman::findOrFail($id)->barang_id;
        return view('peminjaman.show', compact('peminjamans', 'konsumens', 'barangs', 'selectedKonsumen', 'selectedBarang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjamanss
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
     * @param  \App\Peminjaman  $peminjamanss
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $pertama = DateTime::on()->format('Y-m-d');
        // //return $request->konsumen_id;

        // $this->validate(
        //     $request,
        //     [
        //         'tanggal_kembali' => 'required|date_format:Y-m-d|after:' . $pertama,
        //     ],
        //     [
        //         'tangal_kembali.after' => 'Tidak ada Tanggal pengembalian'
        //     ]
        // );

        $pengembalian = new Pengembalian;
        $pengembalian->konsumen_id = $request->konsumen_id;
        $pengembalian->barang_id = $request->barang_id;
        $pengembalian->jumlah_pinjam = $request->jumlah_pinjam;
        $pengembalian->tanggal_pinjam = $request->tanggal_pinjam;
        $pengembalian->tanggal_batas = $request->tanggal_batas;
        $pengembalian->tanggal_kembali = $request->tanggal_kembali;
        $pengembalian->keterangan = $request->keterangan;

        $batasdate = $request->tanggal_batas;
        $kembalidate = $request->tanggal_kembali;
        $datetime1 = new DateTime($batasdate);
        $datetime2 = new DateTime($kembalidate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%r%a');
        $barangs = Barang::findOrFail($request->barang_id);
        $barangs->stock = $barangs->stock + $request->jumlah_pinjam;

        if ($days > 0) {
            $denda = $days * $barangs->denda;
        } else {
            $denda = 0;
        }

        $pengembalian->denda = $denda;
        $peminjamans = Peminjaman::findOrFail($id);


        $barangs->save();
        $peminjamans->delete();
        $pengembalian->save();
        Alert::success(" Berhasil, Mengembalikan " . $barangs->nama)->autoclose(5000);

        return redirect()->route('pengembalian.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjamanss
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $peminjamans = Peminjaman::findOrFail($id);
        // $peminjamans->delete();
        // return redirect()->route('peminjaman.index');
    }

    public function getIdKonsumen(request $request)
    {
        $konsumens = Konsumen::find($request->id);
        $konsumen_id = $konsumens->id;

        return json_encode([
            "konsumen_id" => $konsumen_id,
        ]);
    }
}
