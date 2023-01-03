@extends('layouts.app')

@section('content')

<style>
th, td {
    border: 1px solid #DCDCDC;
}
</style>

<div class="pagetitle">
    <h1>Keranjang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('pelanggan.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Kategori</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="container">
        <table id="table-kategori" class="table-kategori" style="width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <form method="POST" action="{{route('pelanggan.keranjang.acc')}}">
        @method('PUT')
        @csrf
        <button class="btn btn-primary">Beli Semua</button>
    </form>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        console.log('masok')

        $('.table-kategori').DataTable({
            language: {
                searchPlaceholder: 'Cari Kategori',
                sEmptyTable:   'Tidak ada data yang tersedia pada tabel ini',
                sProcessing:   'Sedang memproses...',
                // sLengthMenu:   'Tampilkan _MENU_ entri',
                sZeroRecords:  'Tidak ditemukan data yang sesuai',
                sInfo:         'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                sInfoEmpty:    'Menampilkan 0 sampai 0 dari 0 entri',
                sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
                sInfoPostFix:  '',
                sSearch:       '',
                sUrl:          '',
                oPaginate: {
                sFirst:    'Pertama',
                sPrevious: 'Sebelumnya',
                sNext:     'Selanjutnya',
                sLast:     'Terakhir'
                }
            },
            paging: true,
            responsive: true,
            processing: true,
            scrollX: true,
            filter : true,
            lengthChange: true,
            ajax: {
                url: "{{route('pelanggan.keranjang.getdata')}}",
                data: {
                },
            },
            columns:[
                {data: 'id',
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'nama', name: 'nama'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'harga', name: 'harga'},
                {data: 'total_harga', name: 'total_harga'},
                {data: 'aksi', name: 'aksi'},
            ]
        });
    });
</script>
@endpush
