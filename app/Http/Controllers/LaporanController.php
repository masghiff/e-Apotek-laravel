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


class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.laporan.index');
    }

    public function getData(Request $request)
    {
        $data = Transaksi::select('transaksis.id',
                    'transaksis.nota', 'kategoris.nama as kategori',
                    'obats.nama', 'transaksis.jumlah', 'obats.harga',
                    DB::raw("SUM(transaksis.jumlah * obats.harga) as total_harga"))
                ->join('users', 'users.id', '=', 'transaksis.user_id')
                ->join('obats', 'obats.id', '=', 'transaksis.obat_id')
                ->join('kategoris', 'kategoris.id', '=', 'obats.kategori_id')
                ->where('transaksis.status', 'sukses')
                ->when(!empty($request->bulan), function($q) use($request) {
                    return $q->whereMonth('transaksis.created_at', $request->bulan);
                })
                ->when(!empty($request->tahun), function($q) use($request) {
                    return $q->whereYear('transaksis.created_at', $request->tahun);
                })
                ->orderBy('transaksis.created_at', 'DESC')
                ->groupBy('transaksis.id', 'transaksis.nota', 'kategoris.nama', 'obats.nama',
                'transaksis.jumlah', 'obats.harga');

        return DataTables::of($data)->addIndexColumn()
                        ->rawColumns(['aksi'])
                        ->make(true);
    }

    public function rekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $data = Transaksi::select(
                DB::raw("SUM(transaksis.jumlah * obats.harga) as total_harga"))
            ->join('obats', 'obats.id', '=', 'transaksis.obat_id')
            ->where('transaksis.status', 'sukses');
        if(!empty($bulan))
        {
            $data = $data->whereMonth('transaksis.created_at', $bulan);
        }

        if(!empty($tahun))
        {
            $data = $data->whereYear('transaksis.created_at', $tahun);
        }

        $data = $data->get();

        return Response($data[0]->total_harga);

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
