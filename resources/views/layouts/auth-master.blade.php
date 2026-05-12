<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    {!! Meta::tag('title') !!}
    {!! Meta::tag('description') !!}
    {{--
    {!! Meta::tag('image') !!}
    {!! Meta::tag('type','website') !!}
    {!! Meta::tag('locale', 'id_ID') !!}
    {!! Meta::tag('canonical', url()->current()) !!}
    {!! Meta::tag('twitter:card', 'summary_large_image') !!}
    --}}
	<meta name="author" content="digiworks" />
	<meta name="robots" content="no-follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//kit.fontawesome.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">


	<!-- FAVICONS ICON -->
	<link rel="icon" type="image/png" href="{{asset('images/dw.png') }}">
    <link rel="shortcut icon" href="{{asset('images/dw.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{asset('images/dw.png') }}">

	<!-- PAGE TITLE HERE -->
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{asset('images/dw.png') }}" />
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link class="main-css" data-url="{{ asset('/assets') }}" href="{{ asset('assets/css/style.css') }}" rel="stylesheet">


    @yield('styles')
    <style>
       /*  .authincation{
            background-color: #291D76;
            background-image: linear-gradient(45deg, #291D76, #2964BD);
        }
        .btn-primary {
            border-color: #291D76;
            background-color: #291D76;
        }
        .form-control{
            border: 0.0625rem solid #87d1fc;
        }
        .dlabnav {
            background-color: #291D76;
            background-image: linear-gradient(45deg, #291D76, #2964BD);
        } */
    </style>
</head>

<body>
    <div class="fix-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/dlabnav-init.js')}}"></script>

	@yield('scripts')
</body>
</html>