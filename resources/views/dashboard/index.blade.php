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
            <div class="col-xl-12">
                <div class="card " id="user-activity">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <h4 class="card-title mb-0">Point Stats this Month</h4>
                        <div class="mt-3 mt-sm-0">
                            <!-- <ul class="nav nav-tabs vacany-tabs style-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" data-series="Daily" href="#Daily" role="tab">Daily</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-bs-toggle="tab" data-series="Weekly" href="#Weekly" role="tab">Weekly</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" data-series="Monthly" href="#Monthly" role="tab">Monthly</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="card-body pt-3 px-sm-3 px-0 pb-1">
                        <div class="pb-sm-4 mb-3 d-flex flex-wrap px-3">
                            <div class="d-flex align-items-center">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                    <rect width="13" height="13" rx="6.5" fill="#35c556" />
                                </svg>
                                <span class="text-dark fs-13 font-w500">Point Teknis</span>
                            </div>
                            <div class="application d-flex align-items-center">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                    <rect width="13" height="13" rx="6.5" fill="#3f4cfe" />
                                </svg>
                                <span class="text-dark fs-13 font-w500">Point Manajerial</span>
                            </div>
                            <div class="application d-flex align-items-center">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
                                    <rect width="13" height="13" rx="6.5" fill="#D55BC1" />
                                </svg>
                                <span class="text-dark fs-13 font-w500">Total Point</span>
                            </div>
                        </div>
                        <div class="">
                            <div id="chartBar" class="chartBar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>



@endsection
@section('scripts')
<script src="{{asset('assets/vendor/apexchart/apexchart.js')}}"></script>
<script>
    (function($) {

        var data = @json($data);
        console.log(data.pointMajarerial);



        var chartBar = function(){
		
		var options = {
			  series: [
				{
					name: 'Point Teknis',
					data: data.pointTask,
					//radius: 12,	
				}, 
				{
				  name: 'Point Manajerial',
				  data: data.pointMajarerial
				},
                {
				  name: 'Total Point',
				  data: data.total_point
				}
				
			],
				chart: {
				type: 'bar',
				height: 230,
				
				toolbar: {
					show: false,
				},
				
			},
			plotOptions: {
			  bar: {
				horizontal: false,
				columnWidth: '25%',
				endingShape: 'rounded'
			  },
			},
			colors:["#35c556", "#3f4cfe",'#D55BC1'],
			dataLabels: {
			  enabled: false,
			},
			markers: {
				shape: "circle",
			},
		
			grid : {
				show:true,
				strokeDashArray: 6,
			},
			legend: {
				show: false,
				fontSize: '12px',
				labels: {
					colors: '#000000',
					
					},
				markers: {
				width: 18,
				height: 18,
				strokeWidth: 0,
				strokeColor: '#fff',
				fillColors: undefined,
				radius: 12,	
				}
			},
			stroke: {
			  show: true,
			  width: 1,
			  colors: ['transparent']
			},
			
			xaxis:{
			
			  	categories: data.user,
			  	grid: {
					color: "rgba(233,236,255,0.5)",
					drawBorder: true
				},
			  	labels: {
					style: {
						colors: '#787878',
						fontSize: '13px',
						fontFamily: 'poppins',
						fontWeight: 100,
						cssClass: 'apexcharts-xaxis-label',
					},
				},
			  	crosshairs: {
					show: false,
			  	},
				axisTicks : {
					show : false
				},
				axisBorder : {
					show : false
				},
			},
			yaxis:{
				labels: {
				   style: {
					  colors: '#787878',
					  fontSize: '13px',
					   fontFamily: 'poppins',
					  fontWeight: 100,
					  cssClass: 'apexcharts-xaxis-label',
				  },
				},
			},
			fill: {
			  opacity: 1
			},
			tooltip: {
			  y: {
				formatter: function (val) {
				  return "" + val
				}
			  }
			}
			};

			var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
			chartBar1.render();
	}

    chartBar();

    })(jQuery);
</script>
@endsection