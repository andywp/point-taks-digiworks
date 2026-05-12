@extends('layouts.app')
@section('header_title','Task')
@section('styles')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    #kt_table_users td:nth-child(3),
    #kt_table_users th:nth-child(3) {
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
                    <a href="javascript:void(0);" class="handle expand"><i class="fal fa-angle-down"></i></a>
                </div>
            </div>
            <div class="cm-content-body form excerpt">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                            <label class="form-label">Task</label>
                            <select name="user" id="task" class="form-control select2">
                                <option value="">all</option>
                                @foreach($master as $r)
                                <option value="{{ $r->id }}">{{ $r->pekerjaan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                            <label class="form-label">Brand</label>
                            <select name="brand" id="brand" class="form-control select2">
                                <option value="">All</option>
                                @foreach($brand as $r)
                                <option value="{{ $r->id }}">{{ $r->brand}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                            <div class="mb-0">
                                <label class="form-label">Periode</label>
                                <input type="text" name="tanggal" id="tanggal" class="form-control form-control-xs reportrange" style="height: 2.5rem;" value="">
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 align-self-end">
                            <div>
                                <button type="button" id="filter" class="btn btn-primary me-2" title="Click here to Search" type="button"><i class="fa fa-filter me-1"></i>Apply Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Detail Task</h4>
                <div class="ms-auto">
                    <!-- <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> New Brand</a > -->
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="fas fa-plus"></i> Add New Task
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kt_table_users" class="display responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th class="text-center" >Tanggal</th>
                                <th class="text-center" >Brand</th>
                                <th class="text-center" >Pekerjaan</th>
                                <th class="text-center" >Output</th>
                                <th class="text-center" >Point</th>
                                <th class="text-center" >#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal add new task -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="{{ route('admin.task.store') }}" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add New Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Preview</button>
        </div>
        </div>
    </form>
  </div>
</div>
<!---  end modal aa new task -->


@endsection
@section('scripts')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.mdate').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            weekStart: 0,
            time: false,
            defaultDate: new Date()
        });

        $('.select2').select2();

        var start = moment().startOf('month');
        var end = moment().endOf('month');

        let loadData = () => {
            if (!$.fn.dataTable.isDataTable('#kt_table_users')) {

                let tanggal = $('#tanggal').val();
                let task = $('#task').val();
                let brand = $('#brand').val();

                var tbl = $('#kt_table_users').DataTable({
                    pageLength: 10,
                    lengthChange: true,
                    bFilter: true,
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    order: [
                        [1, "desc"]
                    ],
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
                        url: "{{route('admin.task.data')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {
                            tanggal: tanggal,
                            task: task,
                            brand: brand
                        }
                    },
                    columns: [{
                            data: 'tanggal',
                            name: 'tanggal',
                            width: "100px"
                        },
                        {
                            data: 'brand',
                            name: 'brand',
                            width: "50px"
                        },
                        {
                            data: 'task',
                            name: 'task',
                            width: "40%"
                        },
                        {
                            data: 'output',
                            name: 'output',
                            className: "text-end",
                            width: "50px"
                        },
                        {
                            data: 'point',
                            name: 'point',
                            width: "50px",
                            className: "text-end"
                        },
                        {
                            data: 'action',
                            name: 'id',
                            className: "text-center",
                            //orderable: false, 
                            searchable: false,
                            width: "40px"
                        },
                    ],
                    fnDrawCallback: function() {
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
        }, cb);

        $('#filter').on('click', function() {
            $('#kt_table_users').dataTable().fnDestroy();
            loadData();
        });
        loadData();



        $('#kt_table_users').on('click', '.delete', function() {
            // e.preventDefault();
            Swal.fire({
                    title: "Warning..!",
                    text: "Do you want to delete Task " + $(this).data('name') + " ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Ok',
                    cancelButtonColor: '#d33',
                    buttons: true,
                    dangerMode: true,
                })
                .then((value) => {
                    //console.log(value,'value');
                    if (value.value) {
                        $('#fd' + $(this).data('id')).submit();
                    } else {
                        return false;
                    }
                });
            return false;
        });

        $('form').submit(function() {
            const loading = $('#loading-area');
            var button = $(this);
            loading.show();
            $('#submit').attr('disabled', 'disabled');
            return true;
        });

        $('#addNewBrand').on('click', function() {
            $('#exampleModal').modal('show');
            return false;
        });

    });
</script>

@if ($errors->any())
<script>
    $(function() {
        $('#exampleModal').modal('show');
        // return false;
    });
</script>
@endif
@if(session('success'))
<script>
    notif("{{ session('success') }}");
</script>
@endif
@endsection