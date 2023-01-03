<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Helper\Uuid;
use App\Helper\Storage;
use Alert;

class ObatController extends Controller
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
        return view('admin.obat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori = Kategori::select('id', 'nama')->get();
        $supplier = Supplier::select('id', 'nama')->get();

        return view('admin.obat.create', compact('kategori', 'supplier'));
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
        $uuid = Uuid::getId();

        $obat = new Obat();
        $obat->id = $uuid;
        $obat->nama = $request->nama;
        $obat->stok = $request->stok;
        $obat->harga = $request->harga;
        $obat->status = 'aktif';
        $obat->kategori_id = $request->kategori;
        $obat->supplier_id = $request->supplier;
        if($request->hasFile('image'))
        {
            $uploadImage = Storage::uploadImageObat($request->file('image'));
            $obat->foto = $uploadImage;
        }
        $obat->save();

        Alert::success('Sukses!', 'Tambah Obat Sukses');
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
        $data = Obat::select('obats.id', 'obats.nama',
            'obats.stok', 'obats.harga', 'obats.foto',
            'kategoris.nama as kategori', 'suppliers.nama as supplier')
            ->join('kategoris', 'kategoris.id', 'obats.kategori_id')
            ->join('suppliers', 'suppliers.id', 'obats.supplier_id')
            ->where('obats.id', $id)
            ->first();
        $kategori = Kategori::select('id', 'nama')->get();
        $supplier = Supplier::select('id', 'nama')->get();

        return view('admin.obat.edit', compact('data', 'kategori', 'supplier'));
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

        $obat = Obat::where('id', $id)->first();
        $obat->nama = $request->nama;
        $obat->stok = $request->stok;
        $obat->harga = $request->harga;
        $obat->kategori_id = $request->kategori;
        $obat->supplier_id = $request->supplier;
        if($request->hasFile('image'))
        {
            $uploadImage = Storage::uploadImageObat($request->file('image'));
            $obat->foto = $uploadImage;
        }
        $obat->save();

        Alert::success('Sukses!', 'Update Obat Sukses');
        return back();
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
        $data = Obat::where('id', $id)->first();
        $data->status = 'nonaktif';
        $data->save();
        Alert::success('Sukses!', 'Data berhasil di hapus!');
        return back();
    }
}
