@extends('layouts.app')
@section('header_title','Task')
@section('styles')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    #kt_table_users td:nth-child(3) span,
    #kt_table_users th:nth-child(3) span {
        width: 40%;
        max-width: 40%;
        white-space: normal !important;   
        word-break: break-word;          
    }

    #kt_table_users td:nth-child(6),
    #kt_table_users th:nth-child(6) {
        width: 20%;
        max-width: 20%;
        white-space: normal !important;  
        word-break: break-word;          
    }

    .select2-container--open {
        z-index: 2000 !important;
    }
    .select2-selection.is-invalid {
        border: 1px solid #dc3545 !important;
    }

    .select2-selection.is-valid {
        border: 1px solid #198754 !important;
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
                                <option value="{{ $r->id }}" data-color="{{ !empty($r->color)?$r->color:'#fff' }}">{{ $r->pekerjaan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-3  col-sm-6 mb-3 mb-xl-0">
                            <label class="form-label">Brand</label>
                            <select name="brand" id="brand" class="form-control select2">
                                <option value="">All</option>
                                @foreach($brand as $r)
                                <option value="{{ $r->id }}"  >{{ $r->brand}}</option>
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
                    <button id="addNewTask" type="button" class="btn btn-outline-primary btn-sm">
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
                                <th class="text-center" >Note</th>
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
 <div class="modal fade" id="modaAddNewTask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="formAddNewTask" action="{{ route('admin.task.store') }}" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaAddNewTaskLabel">Add New Task</h5>
        </div>
        <div class="modal-body">
            <div id="taskWrapper" class="mb-3">
                <!-- ROW -->
                <div class="task-item border rounded p-3 mb-3">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Brand</label>
                            <select class=" select2nodal" name="brand[]">
                                <option value="">Pilih</option>
                                @foreach($brand as $r)
                                    <option value="{{ $r->id }}">{{ $r->brand }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <select class=" select2nodal" name="pekerjaan[]">
                                <option value="">Pilih</option>
                                @foreach($master as $r)
                                    <option value="{{ $r->id }}">{{ $r->pekerjaan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal[]" class="form-control mdate">
                        </div>

                        <div class="col-md-1 mb-3">
                            <label class="form-label">Output</label>
                            <input type="number" name="output[]" class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Note</label>
                            <textarea class="form-control" name="note[]"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end mb-3">
                            <button title="Delete Row" type="button"
                                    class="btn btn-danger removeRow w-100">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- END ROW -->
            </div>
            <div class="text-end">
                <button type="button" class="btn btn-primary btn-sm ms-auto" id="addRow">
                    <i class="fas fa-plus"></i> Add Row
                </button>
            </div>
            <div class="errorMsg"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="previewBtn" >Preview</button>
        </div>
        </div>
    </form>
  </div>
</div>
<!---  end modal aa new task -->
 <div class="modal fade" id="modalPreview" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=modalPreviewLabel">Preview</h5>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead  class="text-center">
                        <tr>
                            <th>Brand</th>
                            <th>Pekerjaan</th>
                            <th>Tanggal</th>
                            <th>Output</th>
                            <th>Note</th>
                        </tr>
                    </thead>

                    <tbody id="previewBody"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnBack">Back</button>
                <button type="button" class="btn btn-primary" id="btnSave"><span id="loading-area" style="display: none;"  ><i class="fas fa-spinner fa-spin"></i> Loading...</span> Save</button>
            </div>
        </div>
    </div>
</div>

<!-- modal priview -->

<!-- end modal priview -->
@endsection
@section('scripts')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* $('.mdate').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            weekStart: 0,
            time: false,
            defaultDate: new Date()
        }); */
        
        const formatOption = (state) =>{
            if (!state.id) {
                return state.text;
            }

            let color = $(state.element).data('color');

            return $(`
                    <div style="
                        background:${color};
                    ">
                        ${state.text}
                    </div>
                `);
        }


        $('.select2').select2(/* {
            templateResult: formatOption,
            templateSelection: formatOption
        } */);

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
                            width: "50px"
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
                            width: "25px"
                        },
                        {
                            data: 'point',
                            name: 'point',
                            width: "25px",
                            className: "text-end"
                        },
                        {
                            data: 'note',
                            name: 'note',
                            width: "20%",
                            className: "text-start"
                        },
                        {
                            data: 'action',
                            name: 'id',
                            className: "text-center",
                            //orderable: false, 
                            searchable: false,
                            width: "20px"
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
            $('#btnBack').attr('disabled', 'disabled');
            $('#btnSave').attr('disabled', 'disabled');
            return true;
        });

       
        //addNewTask
        $('#addNewTask').on('click', function() {
            $('#modaAddNewTask').modal('show');
            return false;
        });
        //btnBack
        $('#btnBack').on('click', function() {
            $('#modalPreview').modal('hide');
            $('#modaAddNewTask').modal('show');
            return false;
        });


        const validateForm = () => {
            let isValid = true;
            $('.is-invalid').removeClass('is-invalid');
            $('.task-item').each(function () {
                let brand = $(this).find('select[name="brand[]"]');
                let pekerjaan = $(this).find('select[name="pekerjaan[]"]');
                let tanggal = $(this).find('input[name="tanggal[]"]');
                let output = $(this).find('input[name="output[]"]');
                // BRAND
                if(brand.val() == '') {
                    brand.next('.select2-container')
                        .find('.select2-selection')
                        .addClass('is-invalid');
                    isValid = false;
                }else{
                    brand.next('.select2-container')
                        .find('.select2-selection')
                        .removeClass('is-invalid');
                }

                if(pekerjaan.val() == '') {
                    pekerjaan.next('.select2-container')
                        .find('.select2-selection')
                        .addClass('is-invalid');
                    isValid = false;
                }else{
                    pekerjaan.next('.select2-container')
                        .find('.select2-selection')
                        .removeClass('is-invalid');
                }

                // TANGGAL
                if (tanggal.val() == '') {
                    tanggal.addClass('is-invalid');
                    isValid = false;
                }

                // OUTPUT
                if (output.val() == '' || output.val() <= 0) {
                    output.addClass('is-invalid');
                    isValid = false;
                }

            });

            return isValid;
        }

        //previewBtn
        $('#previewBtn').on('click', function() {
            let errorMsg=$('.errorMsg');

            errorMsg.html();
            if (!validateForm()) {
                //alert('Masih ada field yang kosong');
                /* errorMsg.html(`<div class="alert alert-danger">
                                Please correct the input above
                            </div>`); */
                notif("Please correct the input above",'warning');
                return false;
            }

            let isValid = true;
            let preview = '';
            $('.task-item').each(function () {
                let brand = $(this).find('select[name="brand[]"] option:selected').text();
                let pekerjaan = $(this).find('select[name="pekerjaan[]"] option:selected').text();
                let tanggal = $(this).find('input[name="tanggal[]"]').val();
                let output = $(this).find('input[name="output[]"]').val();
                let note = $(this).find('textarea[name="note[]"]').val();

                let dateFormate=moment(tanggal).format('DD MMMM YYYY');

                preview += `
                    <tr>
                        <td>${brand}</td>
                        <td>${pekerjaan}</td>
                        <td>${dateFormate}</td>
                        <td class="text-end" >${output}</td>
                        <td class="text-start" >${note}</td>
                    </tr>
                `;
            });

            $('#previewBody').html(preview);


            $('#modalPreview').modal('show');
            $('#modaAddNewTask').modal('hide');
            return false;
        });


        //btnSave
        $('#btnSave').on('click', function() {
            //$('#modalPreview').modal('hide');
            //$('#modaAddNewTask').modal('show');
            $("#formAddNewTask").trigger("submit");
            return false;
        });

       

        $('.select2nodal').select2({
            dropdownParent: $('#modaAddNewTask'),
            width: '100%'
        });

        /* $('#modaAddNewTask').on('shown.bs.modal', function () {

            $('.select2modal').select2({
                dropdownParent: $('#modaAddNewTask'),
                width: '100%'
            });

        }); */

        const initSelect2 = () =>{
            /* $('.select2nodal').select2('destroy');
            $('.select2nodal').select2({
                dropdownParent: $('#modaAddNewTask'),
                width: '100%'
            }); */
            $('.select2nodal').each(function () {

                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }

                $(this).select2({
                    dropdownParent: $('#modaAddNewTask'),
                    width: '100%'
                });

            });
        }


        const initDatePicker =() =>{
           /*  $('.mdate').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                weekStart: 0,
                time: false,
                defaultDate: new Date()
            }); */

           /*  $('.mdate').bootstrapMaterialDatePicker('destroy');
            $('.mdate').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD',
                weekStart: 0,
                time: false,
                defaultDate: new Date()
            }); */

           /*  $('.mdate').each(function () {

                if ($(this).data('plugin_bootstrapMaterialDatePicker')) {
                    $(this).bootstrapMaterialDatePicker('destroy');
                }

                $(this).bootstrapMaterialDatePicker({
                    format: 'YYYY-MM-DD',
                    weekStart: 0,
                    time: false,
                    defaultDate: new Date()
                });

            }); */

        }


        //initSelect2();

        /*** input formmm */
        $('#addRow').click(function () {

            let html = `
                <div class="task-item border rounded p-3 mb-3">

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Brand</label>

                            <select class="select2nodal" name="brand[]">
                                <option value="">Pilih</option>

                                @foreach($brand as $r)
                                    <option value="{{ $r->id }}">
                                        {{ $r->brand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Pekerjaan</label>

                            <select class="select2nodal" name="pekerjaan[]">
                                <option value="">Pilih</option>

                                @foreach($master as $r)
                                    <option value="{{ $r->id }}">
                                        {{ $r->pekerjaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Tanggal</label>

                            <input type="date"
                                name="tanggal[]"
                                class="form-control mdate">
                        </div>

                        <div class="col-md-1 mb-3">
                            <label class="form-label">Output</label>

                            <input type="number"
                                name="output[]"
                                class="form-control">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">Note</label>
                            <textarea class="form-control" name="note[]"></textarea>
                        </div>
                        <div class="col-md-1 d-flex align-items-end mb-3">

                            <button type="button"
                                    class="btn btn-danger removeRow w-100">
                                <i class="fa fa-trash"></i>
                            </button>

                        </div>

                    </div>

                </div>
            `;

            $('#taskWrapper').append(html);

            //$('.select2').select2();
            //$('.select2nodal').select2(settingSelect2);
            initSelect2();
            initDatePicker();
        });



        $(document).on('click', '.removeRow', function () {
            $(this).closest('.task-item').remove();
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