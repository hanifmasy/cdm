@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="{{ asset('public/css/dataTables.bootstrap4.css') }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.edukasi-pelanggan.downloadEdukasi') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="staticName" class="col-sm-4 col-form-label">NPER</label>
                    <select class="form-control select2 {{ $errors->has('nper') ? 'is-invalid' : '' }}" name="nper" id="nper" required>
                        @foreach($nper as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="staticName" class="col-sm-4 col-form-label">Jumlah Download</label>
                    <select class="form-control select2 {{ $errors->has('jumlah') ? 'is-invalid' : '' }}" name="jumlah" id="jumlah" required>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                        <option value="900">900</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Download</button>
            </form>
        </div>
    </div>
</div><br>
<div class="col-12">
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.edukasiPelanggan.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table datatable" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        {{ "No." }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.nper') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.witel_str') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.nama_pelanggan') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.alamat') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.notel') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.paket_inet') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.no_hp') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.status_svm') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.valid_from') }}
                                    </th>
                                    
                                    <th>
                                        {{ trans('cruds.edukasiPelanggan.fields.payment_date') }}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function () {
    let dtOverrideGlobals = {
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.edukasi-pelanggan.edukasi') }}",
    columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false},
        { data: 'nper', name: 'nper' },
        { data: 'witel_str', name: 'witel_str' },
        { data: 'nama_pelanggan', name: 'nama_pelanggan' },
        { data: 'alamat', name: 'alamat' },
        { data: 'notel', name: 'notel' },
        { data: 'paket_inet', name: 'paket_inet' },
        { data: 'no_hp', name: 'no_hp' },
        { data: 'email', name: 'email' },
        { data: 'status_svm', name: 'status_svm' },
        { data: 'valid_from', name: 'valid_from' },
        { data: 'payment_date', name: 'payment_date' },
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('#order-listing').DataTable(dtOverrideGlobals);
//   $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
//       $($.fn.dataTable.tables(true)).DataTable()
//           .columns.adjust();
//   });
});

</script>
@endsection