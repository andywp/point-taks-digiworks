<?php

namespace App\Http\Controllers\finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TaskPoint;
use App\Models\Manajerial;

use Carbon\Carbon;
use \Meta;


class DashboardController extends Controller
{
    public function index(Request $request){
        Meta::title('Dashboard');
        $now = Carbon::now();
        $periode=($request->periode != '')?$request->periode:$now->format('Y-m');
        $periodeArr=explode('-',$periode);
        $year=$periodeArr[0];
        $bulan=$periodeArr[1];
        $data=array();
        $admin_id=auth('admin')->user()->id;
        $pointTask=TaskPoint::where('admin_id',$admin_id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('point');
        $pointMajarerial= Manajerial::where('admin_id',$admin_id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('poin');

        return view('dashboard.user', compact('pointTask','pointMajarerial'));
    }
}
