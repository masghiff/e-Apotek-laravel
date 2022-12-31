@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Obat</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Obat</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->


  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="col-md-6 mt-3 mb-3">
            <button onclick="window.location.href='{{route('admin.obat.create')}}'" class="btn btn-primary">Tambah Obat</button>
        </div>
        <div class="row">


          <!-- Sales Card -->

          @foreach ($data as $item)
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card"  style="padding: 5%">

              <div class="card-body">
                <h5 class="card-title">{{$item['nama']}} <span>| {{$item['kategori']}}</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/obat/'.$item['foto'])}}" alt="obat" style="border-radius: 50%; height: 100%;">
                  </div>
                  <div class="ps-3">
                    <h6>Rp.{{$item['harga']}}</h6>
                    <span class="text-muted small pt-2 ps-1">stok: </span><span class="text-success small pt-1 fw-bold">{{$item['stok']}}</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <button onclick="window.location.href='{{route('admin.obat.edit', $item['id'])}}'" class="btn btn-info col-md-5">Edit</button>

                <button onclick="window.location.href='{{route('admin.obat.delete', $item['id'])}}'" class="btn btn-danger col-md-5">Delete</button>
              </div>

            </div>
          </div><!-- End Sales Card -->
          @endforeach


        </div>
      </div><!-- End Left side columns -->


    </div>
  </section>

@endsection
