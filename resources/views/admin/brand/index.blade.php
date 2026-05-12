
@extends('layouts.app')
@section('header_title','Brand')
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
                <h4 class="card-title mb-0">Manage Brand</h4>
                <div class="ms-auto">
                    <a href="{{ route('admin.brand.create') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> New Brand</a >
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="kt_table_users"  class="display responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>Brand</th>
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
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#kt_table_users').DataTable({
            responsive: true,
            pageLength: 25,
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
                url:"{{route('admin.brand.data')}}",
                type: "POST" ,
                dataType: 'json'        
            },
            columns: [
                /* {
                    data: 'post_image',
                    width: "80px",
                    className: "text-center",  
                    orderable: false, 
                    searchable: false,                                  
                }, */
                {
                    data: 'brand',                                    
                },
                /* {
                    data: 'date_start',
                    width: "100px"                                    
                }, */
                /* {
                    data : 'publish',
                    name: 'publish',
                    width: "80px"
                },     */                            
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

    });

    $('#kt_table_users').on('change', '.togglepublish', function() {
        let publish = $(this).is(':checked')?1:0;
        let id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.brand.publish') }}",
            data: {id:id,publish:publish},
            dataType: 'json',
            success: function(data){
            if(!data.error){
                notif(data.pesan);
            }else{
                notif('Error omething wrong','warning');
            }
            }
        });

    });
</script>

@if(session('success'))
    <script>
    notif("{{ session('success') }}");
    </script>
@endif
@endsection