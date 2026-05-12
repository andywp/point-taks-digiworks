@extends('layouts.app')
@section('header_title','Summary')
@section('styles')

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

                            <div class="col-xl-6 col-sm-6">
                                <div class="mb-0">
                                    <label class="form-label">Tanggal</label>
                                    <input type="text" name="invoice" id="tanggal" class="form-control form-control-xs reportrange"  style="height: 2.5rem;" value="">
                                </div>
                            </div>
                            <!-- <div class="col-xl-6 col-sm-6 align-self-end">
                                <div>
                                    <button type="submit" class="btn btn-primary me-2" title="Click here to Search" type="button"><i class="fa fa-filter me-1"></i>Filter</button>
                                </div>
                            </div> -->
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
                    <table id="kt_table_users" class="display responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Point Teknis</th>
                                <th>Point Manajerial</th>
                                <th>Total Point</th>
                                <th>Total Over Point</th>
                                <th>Take Home Pay</th>
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

        var start = moment().startOf('month');
        var end = moment().endOf('month');


        $('.select2').select2();

       let loadData=()=>{
        if (! $.fn.dataTable.isDataTable('#kt_table_users') ) {

            let tanggal = $('#tanggal').val();

            var tbl = $('#kt_table_users').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    order: [[ 1, "desc" ]],
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
                        url:"{{route('admin.summary.data')}}",
                        type: "POST" ,
                        dataType: 'json',
                        data:{tanggal:tanggal}        
                    },
                    columns: [
                        {
                            data: 'nama',                                    
                        },
                        {
                            data: 'point_teknis',
                            className: "text-end",                                
                        },
                        {
                            data : 'point_manajerial',
                            width: "50px",
                            className: "text-end",
                        },                                
                        {
                            data : 'total_poin',
                            className: "text-end",
                            width: "50px"
                        },
                        {
                            data : 'total_over_point',
                             className: "text-end",
                            width: "50px"
                        },                                
                        {
                            data: 'take_home_pay',
                            className: "text-center",
                            width: "40px"    
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
           // $('.reportrange').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //let startDate=start.format('YYYY-MM-DD');
            //let endDate=end.format('YYYY-MM-DD');
           // $('.reportrange').val(startDate+'-' + endDate).trigger('change');
            //$('#datamentor').dataTable().fnDestroy();
            //loadData(startDate,endDate);

            //loadData();
            //$('#kt_table_users').dataTable().fnDestroy();
            //loadData();
            $('.reportrange').val(
                start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY')
            ).trigger('change');
        }
        $('.reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            locale: {
                    format: 'DD/MM/YYYY'
            }
           /*  ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            } */
        }, cb);

       $('.reportrange').on('change', function() {
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