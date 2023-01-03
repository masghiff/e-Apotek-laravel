<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Supplier;
use App\Helper\Uuid;
use App\Helper\Storage;
use Alert;
use Illuminate\Support\Facades\Auth;

class PelangganObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Obat::select('obats.id', 'obats.nama', 'obats.stok',
            'obats.harga', 'obats.foto', 'kategoris.nama as kategori',
            'suppliers.nama as supplier')
            ->join('suppliers', 'suppliers.id', '=', 'obats.supplier_id')
            ->join('kategoris', 'kategoris.id', '=', 'obats.kategori_id')
            ->where('obats.status', 'aktif')
            ->get();

            // dd($data);
        return view('pelanggan.obat.index', compact('data'));
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
    public function keranjang(Request $request, $id)
    {
        //

        if(empty($request->jumlah))
        {
            Alert::error('error', 'isi jumlah barang dulu.');
            return \back();
        }

        $uuid = Uuid::getId();
        $keranjang = new Transaksi();
        $keranjang->id = $uuid;
        $keranjang->nota = '-';
        $keranjang->user_id = Auth::user()->id;
        $keranjang->obat_id = $id;
        $keranjang->jumlah = $request->jumlah;
        $keranjang->total_harga = '-';
        $keranjang->status = 'menunggu';
        $keranjang->save();
        Alert::success('Sukses!', 'Berhasil di tambahkan ke keranjang!');
        return back();

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
