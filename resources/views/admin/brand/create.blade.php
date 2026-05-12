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
<h4 class="card-title mb-3" >Add Brand</h4>
<form action="{{ route('admin.brand.store') }}" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8">
            <div class="card h-auto">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text" class="form-control  @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" placeholder="Brand Name">
                        @error('brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="right-sidebar-sticky">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader">
                        <!-- <div class="cpa">
                            Published
                        </div> -->
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body publish-content form excerpt">
                        <div class="card-footer border-top text-end py-3 ">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary  mx-3">Save</button>
                            <a  href="{{ route('admin.brand.index') }}" class="btn btn-outline-danger " >Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </form>

@endsection
@section('scripts')


@endsection