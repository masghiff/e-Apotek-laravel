<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Yajra\DataTables\DataTables;
use App\Helper\Uuid;
use Alert;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.supplier.index');
    }

    public function getData()
    {
        $data = Supplier::where('status', 'aktif')->orderBy('created_at', 'desc');
        return DataTables::of($data)->addIndexColumn()
                        ->addColumn('aksi', function($row){
                            return
                            '<a href="'.route('admin.supplier.edit', $row->id).'">
                            <i class="bi bi-pen-fill"></i> </a>
                            <a class="btn-link-danger modal-deletetab1" href="'.route('admin.supplier.delete', $row->id).'" data-id="#">
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
        return view('admin.supplier.create');
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
        $supplier = new Supplier();
        $supplier->id = $uuid;
        $supplier->nama = $request->nama;
        $supplier->status = 'aktif';
        $supplier->save();

        Alert::success('Sukses!', 'Sukses menambahkan supplier');
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
        $data = Supplier::where('id', $id)->first();
        return view('admin.supplier.edit', compact('data'));
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
        $supplier = Supplier::where('id', $id)->first();
        $supplier->nama = $request->nama;
        $supplier->save();
        Alert::success('Sukses!', 'Data supplier berhasil di ubah!');
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
        $supplier = Supplier::where('id', $id)->first();
        $supplier->status = 'nonaktif';
        $supplier->save();

        Alert::success('Sukses', 'Delete supplier Sukses!');
        return back();
    }
}
