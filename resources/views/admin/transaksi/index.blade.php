@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Transaksi Beli</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Transaksi Beli</li>
      </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="container">

        <div class="col-12">
            <label for="yourUsername" class="form-label">Nomor Nota :</label><br>
            <label for="yourUsername" class="form-label">Nama Pembeli :</label>
            <div class="input-group has-validation">
              <input type="text" name="nama" class="form-control" id="yourUsername" required>
              <div class="invalid-feedback">Please choose a nama pembeli.</div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mb-3">

        <!-- Left side columns -->
        <div class="col-lg-12">
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
