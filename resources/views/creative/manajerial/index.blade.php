@extends('layouts.app')
@section('header_title','Manajerial')
@section('styles')
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
                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                </div>
            </div>
            <div class="cm-content-body form excerpt">
                
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                                <label class="form-label">Brand</label>
                                <select name="brand" id="brand" class="form-control select2">
                                <option value="">All</option>
                                @foreach($brand as $r)
                                    <option value="{{ $r->id }}" >{{ $r->brand}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-sm-6">
                                <div class="mb-0">
                                    <label class="form-label">Tanggal</label>
                                    <input type="text" name="invoice" id="tanggal" class="form-control form-control-xs reportrange"  style="height: 2.5rem;" value="">
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 align-self-end">
                                <div>
                                    <button type="button" id="filter" class="btn btn-primary me-2" title="Click here to Search" ><i class="fa fa-filter me-1"></i>Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <form action="{{ route('admin.manajerial.store') }}" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
        <div class="card h-auto">
            <div class="card-header">
                <h4 class="card-title mb-0">Add New</h4>
            </div>
            <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <select class="form-control select2  @error('brand') is-invalid @enderror" name="brand">
                            <option value="" >Pilih</option>
                            @foreach($brand as $r)
                                <option value="{{ $r->id }}" >{{ $r->brand }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-w600">Tanggal</label>
                        <div class="input-hasicon">
                            <input name="tanggal" type="text" class="form-control mdate @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}">
                            <div class="icon"><i class="far fa-calendar"></i></div>
                        </div>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Job</label>
                        <textarea name="job"  class="form-control @error('job') is-invalid @enderror" rows="4">{{ old('job') }}</textarea>
                        @error('job')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Persentase</label>
                        <input type="number" name="persentase" class="form-control form-control-sm @error('persentase') is-invalid @enderror" value="{{ old('persentase') }}">
                        @error('persentase')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary  mx-3">Save</button>
                        <!-- <a  href="{{ route('admin.manajerial.index') }}" class="btn btn-outline-danger " >Back</a> -->
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Detail Task</h4>
                <div class="ms-auto">
                    <!-- <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> New Brand</a > -->
                   <!--  <a href="{{ route('admin.manajerial.create') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New
                    </a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kt_table_users" class="display  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Brand</th>
                                <th class="w-50">Job</th>
                                <th>Persentase</th>
                                <th>Point</th>
                                <th>#</th>
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
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.select2').select2();

        $('.mdate').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            weekStart: 0,
            time: false,
            defaultDate: new Date()
        });

        var start = moment().startOf('month');
        var end = moment().endOf('month');

        let loadData=()=>{
        if (! $.fn.dataTable.isDataTable('#kt_table_users') ) {

            let tanggal = $('#tanggal').val();
            let task = $('#task').val();
            let user = $('#user').val();
            let brand = $('#brand').val();

            var tbl = $('#kt_table_users').DataTable({
                    responsive: false,
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
                        url:"{{route('admin.manajerial.data')}}",
                        type: "POST" ,
                        dataType: 'json',
                        data:{tanggal:tanggal,task:task,user:user,brand,brand}        
                    },
                    columns: [
                        {
                            data : 'tanggal',
                            width: "100px"
                        },
                        {
                            data : 'brand',
                            width: "50px"
                        },
                        {
                            data : 'job',
                            width: "30%"
                            
                        },
                        {
                            data : 'persentase',
                            width: "50px"
                        },
                        {
                            data : 'poin',
                            width: "50px"
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

        $('#kt_table_users').on('click', '.delete', function (){
            // e.preventDefault();
            Swal.fire({
                    title: "Warning..!",
                    text: "Do you want to delete Task "+$(this).data('name')+" ?",
                    icon: "warning",
                    showCancelButton:true,
                    confirmButtonText: 'Ok',
                    cancelButtonColor: '#d33',
                    buttons: true,
                    dangerMode: true,
                })
                .then((value) => {
                    //console.log(value,'value');
                    if(value.value){
                        $('#fd'+$(this).data('id')).submit();
                    }else{
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