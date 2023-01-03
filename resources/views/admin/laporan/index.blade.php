@extends('layouts.app')

@section('content')

<style>
th, td {
    border: 1px solid #DCDCDC;
}
</style>

<div class="pagetitle">
    <h1>Laporan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Laporan</li>
      </ol>
    </nav>
</div><!-- End Page Title -->
<section class="section dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mt-4">
                <select class="mt-4 mb-4" name="bulan" id="bulan">
                    <option value="">Pilih Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
              </div>
              <div class="col-md-3 mt-4">
                <select class="mt-4 mb-4" name="tahun" id="tahun">
                    <option value="">Pilih Tahun</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                </select>
              </div>
        </div>

        <table id="table-kategori" class="table-kategori" style="width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nota</th>
                    <th>Kategori</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
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

$('#total_harga').on('keyup',function(){
    console.log('masok')
        $.ajax({
        dataType: 'json',
        type : 'get',
        url : "{{route('admin.laporan.rekap')}}",

        data:{ 'total_harga': $('#total_harga').val(),
        },
        success:function(data)
        {
            console.log(data);
            var res='';
            $.each (data, function (key, value) {
            res += 'total_harga';

   });

            $('tbody').html(res);
        }


    });
})


    $(document).ready(function(){
    fetch_data1();

    function fetch_data1(bulan='', tahun='') {

        $('.table-kategori').DataTable({
            language: {
                searchPlaceholder: 'Cari...',
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
                url: "{{route('admin.laporan.getdata')}}",
                data: {
                    bulan : bulan,
                    tahun : tahun,
                },
            },
            columns:[
                {data: 'id',
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'nota', name: 'nota'},
                {data: 'kategori', name: 'kategori'},
                {data: 'nama', name: 'nama'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'harga', name: 'harga'},
                {data: 'total_harga', name: 'total_harga'},
            ]
        });
    }

    $("#bulan").change(function () {
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();

        $("#table-kategori").DataTable().destroy();

        fetch_data1(bulan, tahun);
    });
    $("#tahun").change(function () {
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();

        $("#table-kategori").DataTable().destroy();

        fetch_data1(bulan, tahun);
    });
    });
</script>
@endpush
