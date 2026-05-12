<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="digiworks.id">
	<meta name="generator" content="digiworks">
    <meta name="developer" content="digiworks">

    {!! Meta::tag('title') !!}
    {!! Meta::tag('description') !!}

    {!! Meta::tag('image') !!}
    {!! Meta::tag('type','website') !!}
    {!! Meta::tag('locale', 'id_ID') !!}
    {!! Meta::tag('canonical', url()->current()) !!}
    {!! Meta::tag('twitter:card', 'summary_large_image') !!}
    {!! Meta::tag('og:geo.region','Indonesia') !!}
    {!! Meta::tag('og:site_name','Diglink.id') !!}
	

    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Favicon icon -->
	<link rel="shortcut icon" type="image/png" href="{{asset('assets/images/favicon.jpg')}}">

	<!-- All StyleSheet -->
	<link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

	<!-- bootstrap5-toggle -->
	<link href="{{asset('assets/vendor/bootstrap5-toggle/bootstrap5-toggle.min.css')}}" rel="stylesheet">

	<!-- select2-->
	<link href="{{asset('assets/vendor/select2/css/select2.min.css')}}" rel="stylesheet">

	<!-- plugins CSS -->
	<link href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/toastr/css/toastr.min.css')}}" rel="stylesheet">


	<link href="{{asset('assets/vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/daterangepicker/daterangepicker.css')}}" rel="stylesheet">
	<!-- Clockpicker -->
    <link href="{{asset('assets/vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="{{asset('assets/vendor/jquery-ascolorpicker/css/ascolorpicker.min.css')}}" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">

    <!-- Pick date -->
	<link href="{{asset('assets/vendor/select2/css/select2.min.css')}}" rel="stylesheet">

	<!-- Datatable -->
    <link href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/datatables/responsive/responsive.css')}}" rel="stylesheet">


	<!-- Globle CSS -->
    <!-- <link class="main-css" href="{{asset('assets/css/style.css')}}" rel="stylesheet"> -->
    <link class="main-css" data-url="{{ asset('/assets') }}" href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link   href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    <!-- custom Css -->
     @yield('styles')
</head>
<body>
	<div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
	<div id="main-wrapper">
        @include('includes.header')

        @include('includes.sidebar')

        <!-- Content body start -->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				@yield('content')
            </div>
        </div>
        <!-- Content body end -->

    	<div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://digiworks.id" target="_blank">digiworks.id</a> <span class="current-year">{{ date('Y') }}</span></p>
            </div>
        </div>
    </div>

    <!-- ain wrapper end -->
	 <!-- Modal -->
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Job Title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal">
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Company Name<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Name" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Position<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Name" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Job Category<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>Choose...</option>
										  <option>QA Analyst</option>
										   <option>IT Manager</option>
										    <option>Systems Analyst</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Job Type<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>Choose...</option>
										  <option>Part-Time</option>
										   <option>Full-Time</option>
										    <option>Freelancer</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">No. of Vancancy<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Name" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Select Experience<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>1 yr</option>
										  <option>2 Yr</option>
										   <option>3 Yr</option>
										    <option>4 Yr</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Posted Date<span class="text-danger scale5 ms-2">*</span></label>
										<div class="input-group">
											 <div class="input-group-text"><i class="far fa-clock"></i></div>
											<input type="date" name="datepicker" class="form-control">
										</div>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Last Date To Apply<span class="text-danger scale5 ms-2">*</span></label>
										<div class="input-group">
											 <div class="input-group-text"><i class="far fa-clock"></i></div>
											<input type="date" name="datepicker" class="form-control">
										</div>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Close Date<span class="text-danger scale5 ms-2">*</span></label>
										<div class="input-group">
											 <div class="input-group-text"><i class="far fa-clock"></i></div>
											<input type="date" name="datepicker" class="form-control">
										</div>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
										<label  class="form-label font-w600">Select Gender:<span class="text-danger scale5 ms-2">*</span></label>
										<select  class="nice-select default-select wide form-control solid">
										  <option selected>Choose...</option>
										  <option>Male</option>
										   <option>Female</option>
										</select>
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Salary Form<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="$" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Salary To<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="$" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter City:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="$" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter State:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="State" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter Counter:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="State" aria-label="name">
									</div>
									<div class="col-xl-6  col-md-6 mb-4">
									  <label  class="form-label font-w600">Enter Education Level:<span class="text-danger scale5 ms-2">*</span></label>
										<input type="text" class="form-control solid" placeholder="Education Level" aria-label="name">
									</div>
									<div class="col-xl-12 mb-4">
										  <label  class="form-label font-w600">Description:<span class="text-danger scale5 ms-2">*</span></label>
										  <textarea class="form-control solid" rows="5" aria-label="With textarea"></textarea>
									</div>
								</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	

	<!-- logout -->
	<form action="{{ route('logout') }}" id="logout-form" method="post">@csrf</form>
	<!-- end lout out -->
    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

    <!-- plugin -->
	<script src="{{asset('assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/vendor/toastr/js/toastr.min.js')}}"></script>

	<!-- select2 -->
	<script src="{{asset('assets/vendor/select2/js/select2.full.min.js')}}"></script>

	<!-- bootstrap5-toggle -->
	<script src="{{asset('assets/vendor/bootstrap5-toggle/bootstrap5-toggle.jquery.min.js')}}"></script>
    <!-- momment js is must -->
    <script src="{{asset('assets/vendor/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

    <!-- clockpicker -->
    <script src="{{asset('assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>

    <!-- asColorPicker -->
    <script src="{{asset('assets/vendor/jquery-ascolor/jquery-ascolor.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-asgradient/jquery-asgradient.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-ascolorpicker/js/jquery-ascolorpicker.min.js')}}"></script>
	<script src="{{asset('assets/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Material color picker -->
    <script src="{{asset('assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <!-- pickdate -->
    <script src="{{asset('assets/vendor/pickadate/picker.js')}}"></script>
    <script src="{{asset('assets/vendor/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('assets/vendor/pickadate/picker.date.js')}}"></script>

    <!-- Daterangepicker -->
    <script src="{{asset('assets/js/plugins-init/bs-daterange-picker-init.js')}}"></script>
    <!-- Clockpicker init -->
    <script src="{{asset('assets/js/plugins-init/clock-picker-init.js')}}"></script>
    <!-- asColorPicker init -->
    <script src="{{asset('assets/js/plugins-init/jquery-ascolorpicker.init.js')}}"></script>

    <script src="{{asset('assets/js/plugins-init/pickadate-init.js')}}"></script>

    <script src="{{asset('assets/js/custom.min.js')}}"></script>
	<script src="{{asset('assets/js/dlabnav-init.js')}}"></script>

	<script src="{{asset('assets/js/dashboard/cms.js')}}"></script>
    <!-- custom sscript -->
	<!-- Datatable -->
    <script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendor/datatables/responsive/responsive.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    @yield('scripts')
</body>
</html>