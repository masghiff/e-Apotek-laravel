@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Tambah Obat</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Tambah Obat</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->


  <section class="section dashboard">
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-12 col-md-12 d-flex flex-column align-items-center justify-content-center">

                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                    </div>

                    <form method="POST" action="{{route('admin.obat.create')}}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                      @csrf
                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Nama Obat</label>
                        <div class="input-group has-validation">
                          <input type="text" name="nama" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">Please choose a nama obat.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Stok</label>
                        <div class="input-group has-validation">
                          <input type="text" name="stok" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">Please choose a stok.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Harga</label>
                        <div class="input-group has-validation">
                          <input type="text" name="harga" class="form-control" id="yourUsername" required>
                          <div class="invalid-feedback">Please choose a harga.</div>
                        </div>
                      </div>

                      <div class="col-12">
                          <label for="yourName" class="form-label">Kategori</label>
                          <select name="kategori" class="form-control">
                            @foreach ($kategori as $item)
                                <option value="{{$item['id']}}">{{$item['nama']}}</option>
                            @endforeach
                            </select>
                          <div class="invalid-feedback">Please, enter your kategori</div>
                      </div>

                      <div class="col-12">
                        <label for="yourName" class="form-label">Supplier</label>
                        <select name="supplier" class="form-control">
                          @foreach ($supplier as $item2)
                              <option value="{{$item2["id"]}}">{{$item2['nama']}}</option>
                          @endforeach
                          </select>
                        <div class="invalid-feedback">Please, enter your supplier</div>
                      </div>

                      <div class="col-12">
                          <label for="yourName" class="form-label">Image</label>
                          <input type="file" name="image" class="form-control" id="yourName" required>
                          <div class="invalid-feedback">Please, enter your image!</div>
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Tambah Obat</button>
                      </div>
                    </form>

                  </div>
                </div>

                <div class="credits">
                  <!-- All the links in the footer should remain intact. -->
                  <!-- You can delete the links only if you purchased the pro version. -->
                  <!-- Licensing information: https://bootstrapmade.com/license/ -->
                  <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>

              </div>
            </div>
          </div>

        </section>

      </div>
  </section>

@endsection
