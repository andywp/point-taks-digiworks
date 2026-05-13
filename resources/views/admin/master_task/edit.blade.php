@extends('layouts.app')
@section('header_title','Master Task')
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
<h4 class="card-title mb-3" >Edit</h4>
<form action="{{ route('admin.master_task.update',$data->id) }}" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8">
            <div class="card h-auto">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan', $data->pekerjaan) }}">
                        @error('pekerjaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Type Nilai</label>
                        <select name="point_type" class="form-control form-control-sm @error('point_type') is-invalid @enderror">
                            <option value="0" {{ (old('pekerjaan', $data->point_type) == 0 )?'selected':'' }} >Harian</option>
                            <option value="1" {{ (old('pekerjaan', $data->point_type) == 1 )?'selected':'' }}>Bulanan</option>
                        </select>
                        @error('point')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Point</label>
                        <input type="number" name="point" class="form-control form-control-sm @error('point') is-invalid @enderror" value="{{ old('point', ($data->point_type ==0)?$data->per_hari:$data->per_bulan) }}">
                        @error('point')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color</label>
                        <select name="color" id="colorSelect" class="form-select @error('color') is-invalid @enderror">
                            <option value="">No</option>
                            <option value="badge-primary" {{ old('color',$data->color)== 'badge-primary' ? 'selected' : '' }}>Primary</option>
                            <option value="badge-secondary" {{ old('color',$data->color)== 'badge-secondary' ? 'selected' : '' }}>Secondary</option>
                            <option value="badge-success" {{ old('color',$data->color)== 'badge-success' ? 'selected' : '' }}>Success</option>
                            <option value="badge-danger" {{ old('color',$data->color)== 'badge-danger' ? 'selected' : '' }}>Danger</option>
                            <option value="badge-warning" {{ old('color',$data->color)== 'badge-warning' ? 'selected' : '' }}> Warning</option>
                            <option value="badge-info" {{ old('color',$data->color)== 'badge-info' ? 'selected' : '' }}>Info</option>
                            <option value="badge-light" {{ old('color',$data->color)== 'badge-light' ? 'selected' : '' }}>Dark</option>
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
            </div>
        </div>
        <div class="col-xl-4">
            <div class="right-sidebar-sticky">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body publish-content form excerpt">
                        
                        <div class="card-footer border-top text-end py-3 ">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-primary  mx-3">Save Update</button>
                            <a  href="{{ route('admin.master_task.index') }}" class="btn btn-outline-danger " >Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </form>

@endsection
@section('scripts')
<script>
    $(function() {
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
@endsection