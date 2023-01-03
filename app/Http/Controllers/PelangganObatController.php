<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Supplier;
use App\Helper\Uuid;
use App\Helper\Storage;
use Yajra\DataTables\DataTables;
use Alert;
use Illuminate\Support\Facades\Auth;
use DB;

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

    public function accKeranjang()
    {

        try{
            $data = Transaksi::select('transaksis.id', 'transaksis.nota', 'transaksis.jumlah', 'transaksis.status', DB::raw("SUM(transaksis.jumlah * obats.harga) as total_harga"))
            ->join('users', 'users.id', '=', 'transaksis.user_id')
            ->join('obats', 'obats.id', '=', 'transaksis.obat_id')
            ->where('transaksis.status', 'menunggu')
            ->where('users.id', Auth::user()->id)
            ->groupBy('transaksis.id', 'transaksis.nota', 'transaksis.jumlah', 'transaksis.status')
            ->get();
            $random = substr(mt_rand(), 0, 7);

            if(isset($random))
            {
                for($i=0; $i < count($data); $i++)
                {
                    $transaksi[$i] = Transaksi::where('user_id', Auth::user()->id)->where('status', 'menunggu')->where('id', $data[$i]['id'])->first();
                    $transaksi[$i]->nota = $random;
                    $transaksi[$i]->total_harga = $data[$i]['total_harga'];
                    $transaksi[$i]->status = 'sukses';
                    $transaksi[$i]->save();
                }
            }

            Alert::success('Sukses!', 'Berhasil membeli obats');
            return back();
        }catch (\Exception $e){

        }



    }

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
    public function show()
    {
        //
        return view('pelanggan.keranjang.index');
    }

    public function getData()
    {
        $data = Transaksi::select('transaksis.id', 'obats.nama', 'transaksis.jumlah', 'obats.harga', DB::raw("SUM(transaksis.jumlah * obats.harga) as total_harga"))
                ->join('users', 'users.id', '=', 'transaksis.user_id')
                ->join('obats', 'obats.id', '=', 'transaksis.obat_id')
                ->where('users.id', Auth::user()->id)
                ->where('transaksis.status', 'menunggu')
                ->orderBy('transaksis.created_at', 'DESC')
                ->groupBy('transaksis.id', 'obats.nama', 'transaksis.jumlah', 'obats.harga');
        return DataTables::of($data)->addIndexColumn()
                        ->addColumn('aksi', function($row){

                                return
                                '<a class="btn-link-danger modal-deletetab1" href="#" data-id="#">
                                <i class="bi bi-trash-fill" style="color:red"></i> </a>';


                        })
                        ->rawColumns(['aksi'])
                        ->make(true);
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
