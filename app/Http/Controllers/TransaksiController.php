<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Transaksi;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Alert;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.transaksi.index');
    }

    public function getData()
    {
        $data = Transaksi::select('transaksis.id', 'transaksis.nota', 'users.nama as user','obats.nama', 'transaksis.jumlah', 'obats.harga', DB::raw("SUM(transaksis.jumlah * obats.harga) as total_harga"))
                ->join('users', 'users.id', '=', 'transaksis.user_id')
                ->join('obats', 'obats.id', '=', 'transaksis.obat_id')
                ->where('transaksis.status', 'pending')
                ->orderBy('transaksis.created_at', 'DESC')
                ->groupBy('transaksis.id', 'transaksis.nota', 'users.nama','obats.nama', 'transaksis.jumlah', 'obats.harga');
        return DataTables::of($data)->addIndexColumn()
                        ->addColumn('aksi', function($row){
                                return
                                '<a class="btn btn-primary" href="'.route('admin.transaksi.acc', $row->nota).'">ACC</a>';
                        })
                        ->rawColumns(['aksi'])
                        ->make(true);
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
    public function store(Request $request, $id)
    {
        //
        $data = Transaksi::where('nota', $id)->get();

        for($i=0; $i < count($data); $i++)
        {
            $acc[$i] = Transaksi::where('nota', $id)->first();
            $acc[$i]->status = 'sukses';
            $acc[$i]->save();
        }
        Alert::success('Sukses', 'Pesanan Sukses');

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
