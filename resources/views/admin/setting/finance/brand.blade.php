@extends('layouts.app')
@section('header_title','Setting Brand Finance')
@section('styles')
<link href="{{asset('assets/vendor/bootstrap-duallistbox/src/bootstrap-duallistbox.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card h-auto">
            <div class="card-header">
                <div class="d-flex align-items-center w-100">
                    <h4 class="card-title" >Manage User</h4>
                </div>
            </div>
            <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form id="formManageBrand" action="{{ route('admin.setting.finance_brand_save') }}" class="needs-validation" method="POST" novalidate>

                        <div class="mb-3">
                            <label  class="form-label">Brand</label>
                            <select id="brand_ids" name="brand[]"  class="form-control form-select" multiple="multiple" require>
                                @foreach($brand as $r)
                                <option value="{{ $r->id }}" {{ in_array($r->id,$brand_finance)?'selected':'' }} >{{ $r->brand }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger Editerror-input" id="typeErrorEdit"></span>
                        </div>
                    
                        <div class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-md btn-primary">Save</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<script src="{{asset('assets/vendor/bootstrap-duallistbox/src/jquery.bootstrap-duallistbox.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

       
        var dualListbox = $('#brand_ids').bootstrapDualListbox({
                nonSelectedListLabel: 'Brand Tersedia',
                selectedListLabel: 'Brand Dipilih',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                filterPlaceHolder: 'Cari Brand',
                infoText: 'Menampilkan {0}',
                infoTextEmpty: 'Data kosong',
                selectorMinimalHeight: 250
        });


    });
</script>

@if (session('success'))
<script>
    notif("{{ session('success') }}");
</script>
@endif

@endsection