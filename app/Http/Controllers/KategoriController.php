<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Obat;
use Yajra\DataTables\DataTables;
use App\Helper\Uuid;
use Alert;
use DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategori.index');
    }

    public function getData()
    {
        $data = Kategori::where('status', 'aktif')->orderBy('created_at', 'desc');
        return DataTables::of($data)->addIndexColumn()
                        ->addColumn('aksi', function($row){
                            return
                            '<a href="'.route('admin.kategori.edit', $row->id).'">
                            <i class="bi bi-pen-fill"></i> </a>
                            <a class="btn-link-danger modal-deletetab1" href="'.route('admin.kategori.delete', $row->id).'" data-id="#">
                            <i class="bi bi-trash-fill" style="color:red"></i> </a>';
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
        return view('admin.kategori.create');
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
        $kategori = new Kategori();
        $kategori->id = $uuid;
        $kategori->nama = $request->nama;
        $kategori->status = 'aktif';
        $kategori->save();

        Alert::success('Sukses!', 'Sukses menambahkan kategori');
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
        $data = Kategori::where('id', $id)->first();
        return view('admin.kategori.edit', compact('data'));
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
        $kategori = Kategori::where('id', $id)->first();
        $kategori->nama = $request->nama;
        $kategori->save();
        Alert::success('Sukses!', 'Data kategori berhasil di ubah!');
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
        $kategori = Kategori::where('id', $id)->first();
        $kategori->status = 'nonaktif';
        $kategori->save();

        Alert::success('Sukses', 'Delete Kategori Sukses!');
        return back();
    }
}
