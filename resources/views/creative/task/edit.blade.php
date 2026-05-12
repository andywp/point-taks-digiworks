@extends('layouts.app')
@section('header_title','Task')
@section('styles')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
<h4 class="card-title mb-3" >Edit Task</h4>
<form action="{{ route('admin.task.update',$data->id) }}" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-12">
            <div class="card h-auto">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <select class="form-control select2  @error('brand') is-invalid @enderror" name="brand">
                            <option value="" >Pilih</option>
                            @foreach($brand as $r)
                                <option value="{{ $r->id }}" {{ ($r->id == $data->brand_id)?'selected':'' }} >{{ $r->brand }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan</label>
                        <select class="form-control select2  @error('pekerjaan') is-invalid @enderror" name="pekerjaan">
                            <option value="" >Pilih</option>
                            @foreach($master as $r)
                                <option value="{{ $r->id }}" {{ ($r->id == $data->master_tasks_id)?'selected':'' }} >{{ $r->pekerjaan }}</option>
                            @endforeach
                        </select>
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-w600">Tanggal</label>
                        <div class="input-hasicon">
                            <input name="tanggal" type="text" class="form-control mdate @error('tanggal') is-invalid @enderror" value="{{ old('tanggal',$data->tanggal) }}">
                            <div class="icon"><i class="far fa-calendar"></i></div>
                        </div>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Output</label>
                        <input type="number" name="output" class="form-control form-control-sm @error('output') is-invalid @enderror" value="{{ old('output',$data->output) }}">
                        @error('output')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-primary  mx-3">Save Update</button>
                        <a  href="{{ route('admin.task.index') }}" class="btn btn-outline-danger " >Back</a>
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
        $('.select2').select2();

        $('.mdate').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD',
            weekStart: 0,
            time: false,
            defaultDate: new Date()
        });

    });
</script>

@endsection