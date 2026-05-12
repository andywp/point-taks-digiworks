@extends('layouts.app')
@section('header_title','Dashboard')
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
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-success text-success">
                                <svg id="icon-database-widget" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database">
                                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                                </svg>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Point Teknis This Month</p>
                                <h4 class="mb-0">{{ $pointTask }}</h4>
                                <!-- <span class="badge badge-success">-3.5%</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-6 col-lg-6 col-sm-6">
                <div class="widget-stat card">
                    <div class="card-body p-4">
                        <div class="media ai-icon">
                            <span class="me-3 bgl-success text-success">
                                <i class="la la-users"></i>
                            </span>
                            <div class="media-body">
                                <p class="mb-1">Point Manajerial Month</p>
                                <h4 class="mb-0">{{ $pointMajarerial }}</h4>
                                <!-- <span class="badge badge-success">-3.5%</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
<!-- <script src="{{asset('assets/vendor/apexchart/apexchart.js')}}"></script> -->
<script>
    
</script>
@endsection