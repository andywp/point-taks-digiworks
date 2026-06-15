@extends('layouts.app')
@section('header_title','Dashboard')
@section('styles')
<style>
	#chartBar .apexcharts-canvas,
	#chartBar .apexcharts-svg {
		overflow: visible !important;
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
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-3" id="user-activity">
                    <div class="card-header border-0 pb-0 flex-wrap">
                        <h4 class="card-title mb-0">Point Stats {{ Bulan($bulan) }} {{ $year }}</h4>
                        <div class="ms-auto">
							<div class="input-group">
								<span class="input-group-text">
									<i class="bi bi-calendar-month"></i>
								</span>
								<input 
									type="text" 
									id="periode" 
									class="form-control"
									placeholder="Pilih Bulan & Tahun"
									autocomplete="off"
									value="{{ $periode }}"
								>
							</div>
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
					<div class="card-footer">
						<div class="py-3 text-center">
						Creative Total Point <b>{{ $report['Creative_total'] }}</b> {!! $report['Creative_report']  !!}
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
	<!-- <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-3">0
                    <div class="card-body">
                        <table class="table display mb-4 dataTablesCard job-table table-responsive-xl card-table dataTable no-footer">
							<thead>
								<th>Devisi</th>
								<th>Total Point</th>
							</thead>
							<tbody>
								<tr>
									<td>Creative</td>
									<td></td>
								</tr>
							</tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    
</div>



@endsection
@section('scripts')
<script src="{{asset('assets/vendor/apexchart/apexchart.js')}}"></script>
<script>
    (function($) {

        var data = @json($data);
        //console.log(data.pointMajarerial);

		let maxData = Math.max(...data.total_point);
		//console.log(maxData,'aaa');

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
				height: 500,
				
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
					/* formatter: function(value, timestamp) {
						//const index = opts.i;
						return value + '\n(OP: wkwkw)';
					}, */
					style: {
						colors: '#787878',
						fontSize: '12px',
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
			annotations: {
				yaxis: [
					{
						y: 261,
						borderColor: '#f72b50',
						label: {
							text: 'Minggu 1 261 point',
							style: {
								background: '#f72b50',
								color: '#fff'
							}
						}
					},
					{
						y: 522,
						borderColor: '#f72b50',
						label: {
							text: 'Minggu 2 522 point',
							style: {
								background: '#f72b50',
								color: '#fff'
							}
						}
					},
					{
						y: 783,
						borderColor: '#f72b50',
						label: {
							text: 'Minggu 3 783 point',
							style: {
								background: '#f72b50',
								color: '#fff'
							}
						}
					},
					{
						y: 1044,
						borderColor: '#f72b50',
						label: {
							text: 'Minggu 4 1044 point',
							style: {
								background: '#f72b50',
								color: '#fff'
							}
						}
					},
				]
			},
			yaxis:{
				min: 0,
				max: maxData < 1500 ? 1500 : maxData,
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
			//chartBar1.render();
			chartBar1.render().then(() => {

				const labels = document.querySelectorAll(
					'#chartBar .apexcharts-xaxis-texts-g text'
				);

				

				labels.forEach((label, index) => {

					console.log(index);
					console.log(data.total_point);
					console.log(data.total_point[index]);

					const x = label.getAttribute('x');
					const y = label.getAttribute('y');

					const user = data.user[index];
					const overPoint = data.under_point[index];

					const html = `
						<foreignObject
							x="${x-35}"
							y="${parseInt(y)+5}"
							width="100"
							height="50">
							<div xmlns="http://www.w3.org/1999/xhtml"
								style="text-align:center;font-size:12px">
								<div>${user}</div>
									${overPoint}
							</div>
						</foreignObject>
					`;

					label.style.display = 'none';

					label.parentNode.insertAdjacentHTML(
						'beforeend',
						html
					);
				});

			});
	}

    chartBar();

	const setDate = "{{ $periode}}";
	//console.log(setDate);
    const today = new Date();
    $('#periode').datepicker({
        format: "yyyy-mm",
        startView: "months",
        minViewMode: "months",
        autoclose: true,
        startDate: new Date(2026, 4, 1),
        //endDate: today
    });
    //.datepicker('setDate', setDate);

	$('#periode').on('change', function() {
		let homeURLadmin= "{{ route('admin.home') }}";
		let value = $(this).val();
		//alert(value);

		window.location.href = homeURLadmin+`?periode=`+value;
	});


    })(jQuery);
</script>
@endsection