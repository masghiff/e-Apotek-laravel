@extends('layouts.app')

@section('content')

<div class="pagetitle">
    <h1>Kategori</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Kategori</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="container">
        <a onclick="window.location.href='{{route('admin.kategori.create')}}'" class="btn btn-primary mt-3 mb-3" style="color: white">Tambah Kategori</a>
        <table id="table-kategori" class="table-kategori" style="width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
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
                url: "{{route('admin.kategori.getdata')}}",
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
                {data: 'aksi', name: 'aksi'},
            ]
        });
    });
</script>
@endpush
