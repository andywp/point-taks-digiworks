@extends('layouts.app')
@section('header_title','Manajerial')
@section('styles')
<style>
    #kt_table_users td:nth-child(4),
#kt_table_users th:nth-child(4) {
    width: 40%;
    max-width: 40%;
    white-space: normal !important;   /* bikin teks turun */
    word-break: break-word;           /* pecah kata panjang */
}
</style>
@endsection
@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="filter cm-content-box box-primary">
            <div class="content-title SlideToolHeader">
                <div class="cpa">
                    <i class="fa-sharp fa-solid fa-filter me-2"></i>Filter
                </div>
                <div class="tools">
                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                </div>
            </div>
            <div class="cm-content-body form excerpt">
                <form action="" method="get">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-2  col-sm-6 mb-3 mb-xl-0">
                                <label class="form-label">User</label>
                                <select name="user" id="user" class="form-control select2">
                                    <option value="">all</option>
                                @foreach($user as $r)
                                    <option value="{{ $r->id }}">{{ $r->name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2  col-sm-6 mb-3 mb-xl-0">
                                <label class="form-label">Brand</label>
                                <select name="brand" id="brand" class="form-control select2">
                                <option value="">All</option>
                                @foreach($brand as $r)
                                    <option value="{{ $r->id }}" >{{ $r->brand}}</option>
                                @endforeach
                                </select>
                            </div>

                            <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                <div class="mb-0">
                                    <label class="form-label">Periode</label>
                                    <input type="text" name="tanggal" id="tanggal" class="form-control form-control-xs reportrange"  style="height: 2.5rem;" value="">
                                </div>
                            </div>
                            
                            <div class="col-xl-2 col-sm-6 align-self-end">
                                <div>
                                    <button type="button" id="filter" class="btn btn-primary me-2" title="Click here to Search" type="button"><i class="fa fa-filter me-1"></i>Apply Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Summary</h4>
                <div class="ms-auto">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kt_table_users" class="display nowrap w-100">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Brand</th>
                                <th>User</th>
                                <th>Job</th>
                                <th>Persentase</th>
                                <th>Point</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2').select2();

        var start = moment().startOf('month');
        var end = moment().endOf('month');

        let loadData=()=>{
        if (! $.fn.dataTable.isDataTable('#kt_table_users') ) {

            let tanggal = $('#tanggal').val();
            let task = $('#task').val();
            let user = $('#user').val();
            let brand = $('#brand').val();

            var tbl = $('#kt_table_users').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    order: [[ 0, "desc" ]],
                    oLanguage: {
                        sZeroRecords: "Tidak Ada Data",
                        sSearch: "Pencarian _INPUT_",
                        sLengthMenu: "_MENU_",
                        sInfo: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                        sInfoEmpty: "0 data",
                        oPaginate: {
                            sNext: "<i class='fa fa-angle-right'></i>",
                            sPrevious: "<i class='fa fa-angle-left'></i>"
                        }
                    },
                    ajax: {
                        url:"{{route('admin.summary.manajerial_data')}}",
                        type: "POST" ,
                        dataType: 'json',
                        data:{tanggal:tanggal,task:task,user:user,brand,brand}        
                    },
                    columns: [
                        {
                            data: 'tanggal',                                    
                        },
                        {
                            data: 'brand.brand',                                    
                        },
                        {
                            data : 'admin.name',
                            width: "80px"
                        },
                        {
                            data : 'job',
                            width: "40%"
                        },                                
                        {
                            data : 'persentase',
                            className: "text-end",
                            width: "50px"
                        },   
                        {
                            data : 'poin',
                            width: "50px",
                            className: "text-end",
                        },
                    ],
                    fnDrawCallback : function() {
                        $('.togglepublish').bootstrapToggle();
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    }
                });
            }
        }



        function cb(start, end) {
           $('.reportrange').val(
                start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY')
            );
        }
        $('.reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            locale: {
                    format: 'DD/MM/YYYY'
            }
        }, cb);

        $('#filter').on('click', function() {
            $('#kt_table_users').dataTable().fnDestroy();
              loadData();
        }); 
       loadData();
 });             
</script>

@if(session('success'))
<script>
    notif("{{ session('success') }}");
</script>
@endif
@endsection