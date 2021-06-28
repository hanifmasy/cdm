@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Reward Kaubis {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form id="filterPerform" type="POST" action="{{route('admin.rewardKaubis.index')}}"
            enctype="multipart/form-data">
            <div class="form-group row">
                <label for="report_month" class="col-md-2 col-form-label">Realisasi</label>
                <div class="col-sm-3 controls">
                    <input class="form-control date" type="text" name="startDate" id="startDate" placeholder="Start Date">
                </div>
                <span style="position: relative; top: 10px"> - </span>
                <div class="col-sm-3 controls">
                    <input class="form-control date" type="text" name="endDate" id="endDate" placeholder="End Date">
                </div>
            </div>

            <div class="form-group row">
                <label for="report_month" class="col-md-2 col-form-label">Kaubis</label>
                <div class="col-sm-6 controls">
                    <input class="form-control" type="text" name="filterKaubis" id="filterKaubis" placeholder="Kaubis">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputWitel" class="col-md-2 col-form-label">Witel</label>
                <div class="col-sm-6 controls">
                    <select class="form-control select2 {{ $errors->has('witel') ? 'is-invalid' : '' }}" name="witel_id"
                        id="witel_id">
                        <option value="">{{trans('global.pleaseSelect')}}</option>
                        @foreach($witels as $id => $witel)
                        <option value="{{ $witel }}">{{ $witel }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-12 offset-2">
                <div class="float-left">
                    <button style="position: relative; right: 5px;" name="searchBtn" id="searchBtn" type="submit"
                        class="btn btn-primary">Filter</button>
                </div>
            </div>
            <br><br>
        </form>

        <hr class="dashed" style="border-top: 3px dashed #bbb">
        <table id="performOrderTable"
            class="table table-bordered table-striped table-hover ajaxTable datatable datatable-rewardKubis"
            width="100%">
            <thead>
                <tr>
                    {{-- <th width="10">

                    </th> --}}
                    <th>
                        {{ trans('cruds.performansi_addon.fields.kaubis') }}
                    </th>
                    <th>
                        {{ trans('cruds.performansi_addon.fields.witel') }}
                    </th>
                    <th class="text-right">
                        Total Addon                        
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="2" style="text-align:right">Total:</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent

<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function () {

        $(".select2" ).select2({
          placeholder: "Silahkan Pilih",          
          theme: "bootstrap4"
        }); 

        fill_datatable();

        function fill_datatable(filter_startDate = '', filter_endDate = '', filter_witel = '', filter_kaubis = '',) {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let url = $('#filterPerform').attr('action');
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                // ajax: "{{ route('admin.rewardKaubis.index') }}",
                ajax: {
                    url: url,
                    data: {
                        filter_startDate: filter_startDate,
                        filter_endDate: filter_endDate,
                        filter_witel: filter_witel,
                        filter_kaubis: filter_kaubis,
                    }
                },
                columns: [{
                        data: 'kaubis',
                        name: 'kaubis'
                    },
                    {
                        data: 'witel',
                        name: 'witel'
                    },
                    {
                        data: 'total_addon',
                        name: 'total_addon',    
                        className: 'text-right' ,
                        sortable: true,                   
                    },
                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api(),
                        data;
                    // converting to interger to find total
                    var intVal = function (i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                //     // Grand Total All Page
                //     // let total = api
                //     //     .column(4)
                //     //     .data()
                //     //     .reduce(function (a, b) {
                //     //         return intVal(a) + intVal(b);
                //     //     }, 0);
                    
                    // Grand Total Current Page
                    let total = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    $( api.column( 2 ).footer() ).html(
                        total
                    );

                    // console.log(total);

                },
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 50,
            };
            let table = $('.datatable-rewardKubis').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        }

        $('#startDate').datetimepicker({
            format: "DD-MM-YYYY",            
        });

        $('#endDate').datetimepicker({
            format: "DD-MM-YYYY",            
        });


        $('#searchBtn').click(function (e) {
            e.preventDefault();
            let filter_startDate = $('#startDate').val();
            let filter_endDate = $('#endDate').val();
            let filter_witel = $('#witel_id').val();
            let filter_kaubis = $('#filterKaubis').val();
            $('#performOrderTable').DataTable().destroy();
            if (filter_startDate != '' && filter_endDate == '') {
                alert('Select filter end date');
            } else if (filter_startDate == '' && filter_endDate != '') {
                alert('Select filter start date');
            } else {
                fill_datatable(filter_startDate, filter_endDate, filter_witel, filter_kaubis);
            }
        });

    });
</script>
@endsection