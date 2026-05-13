@extends('layouts.app')
@section('header_title','Master task')
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Manage Master Task</h4>
                <div class="ms-auto">
                    <!-- <a href="#" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> New Brand</a > -->
                    <button id="addNewBrand" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus"></i> New Master Task
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kt_table_users" class="display responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pekerjaan</th>
                                <th>Per hari</th>
                                <th>Per Bulan</th>
                                <th>Menit Per Output</th>
                                <th>Menit / 10 Menit</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.master_task.store') }}" class="needs-validation" method="POST" novalidate enctype="multipart/form-data" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}">
                        @error('pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type Nilai</label>
                        <select name="point_type" class="form-control form-control-sm @error('point_type') is-invalid @enderror">
                            <option value="0" {{ (old('pekerjaan') == 0 )?'selected':'' }} >Harian</option>
                            <option value="1" {{ (old('pekerjaan') == 1 )?'selected':'' }}>Bulanan</option>
                        </select>
                        @error('point')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Point</label>
                        <input type="number" name="point" class="form-control form-control-sm @error('point') is-invalid @enderror" value="{{ old('point') }}">
                        @error('point')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <select name="color" id="colorSelect" class="form-select @error('color') is-invalid @enderror">
                            <option value="">No</option>
                            <option value="badge-primary" {{ old('color')== 'badge-primary' ? 'selected' : '' }}>Primary</option>
                            <option value="badge-secondary" {{ old('color')== 'badge-secondary' ? 'selected' : '' }}>Secondary</option>
                            <option value="badge-success" {{ old('color')== 'badge-success' ? 'selected' : '' }}>Success</option>
                            <option value="badge-danger" {{ old('color')== 'badge-danger' ? 'selected' : '' }}>Danger</option>
                            <option value="badge-warning" {{ old('color')== 'badge-warning' ? 'selected' : '' }}> Warning</option>
                            <option value="badge-info" {{ old('color')== 'badge-info' ? 'selected' : '' }}>Info</option>
                            <option value="badge-light" {{ old('color')== 'badge-light' ? 'selected' : '' }}>Dark</option>
                        </select>
                        <div class="mt-3">
                            Preview :
                            <span id="colorPreview" class="badge light px-3 py-2">
                                Example Badge
                            </span>
                        </div>
                        @error('color')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                @csrf
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="submit" class="btn btn-outline-primary"><span id="loading-area" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span> <span class="flaticon-381-upload-1"></span> Save</button>
            </div>
    </div>
    </form>
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

        $(".as_colorpicker").asColorPicker();

        $('#kt_table_users').DataTable({
            responsive: true,
            pageLength: 10,
            lengthChange: true,
            bFilter: true,
            destroy: true,
            processing: true,
            serverSide: true,
            //order: [[ 2, "desc" ]],
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
                url:"{{route('admin.master_task.data')}}",
                type: "POST" ,
                dataType: 'json'        
            },
            columns: [                        
                {
                    data: 'action',
                    name: 'id',
                    className: "text-center",
                    //orderable: false, 
                    searchable: false,
                    width: "40px"    
                },
                {
                    data : 'pekerjaan',
                    name: 'pekerjaan',
                    width: "50%"
                },
                {
                    data : 'per_hari',
                    name: 'per_hari',
                    width: "50px"
                },
                {
                    data : 'per_bulan',
                    name: 'per_bulan',
                    width: "50px"
                },
                {
                    data : 'menit_per_output',
                    name: 'menit_per_output',
                    width: "50px"
                },
                {
                    data : 'point_per_10',
                    name: 'point_per_10',
                    width: "50px"
                },    
            ],
            fnDrawCallback : function() {
                $('.togglepublish').bootstrapToggle();
                //$('.select2').select2();
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            }

        });

        $('#kt_table_users').on('click', '.delete', function (){
            // e.preventDefault();
            Swal.fire({
                    title: "Warning..!",
                    text: "Do you want to delete Brand "+$(this).data('name')+" ?",
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


        const updatePreview = () => {
            let color = $('#colorSelect').val();

                $('#colorPreview')
                .removeClass()
                .addClass('badge light px-3 py-2 ' + color)
                .text(color.charAt(0).toUpperCase() + color.slice(1));

        }

        updatePreview();

        $('#colorSelect').on('change', function () {
            updatePreview();
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