<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\TaskPoint;
use App\Models\Manajerial;

use Carbon\Carbon;
use \Meta;

class DashboardController extends Controller
{
    public function index(){
        Meta::title('Dashboard');

        $now = Carbon::now();
        $bulan=$now->month;
        $year=$now->year;
        
        $role=auth('admin')->user()->role;
    
            if($role != 'Creative'){
            $user=Admin::where('role','Creative')->orderBy('name','ASC')->get();
            //dd($user);
            $data=array();
            $karyawan=array();
            $pointTask=array();
            $pointMajarerial=array();
            $total_point=array();
            foreach($user as $r){
                $karyawan[]=$r->name;
                $point_teknis=TaskPoint::where('admin_id',$r->id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('point');
                $point_manajerial=Manajerial::where('admin_id',$r->id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('poin');

                $pointTask[]=$point_teknis;
                $pointMajarerial[]= $point_manajerial;
                $total_point[]=$point_teknis + $point_manajerial;
            }
            $data=[
                'user' => $karyawan,
                'pointTask' => $pointTask,
                'pointMajarerial' => $pointMajarerial,
                'total_point' => $total_point
            ];
           // dd($data);
            return view('dashboard.index', compact('data'));
        }else{
            $data=array();
            $admin_id=auth('admin')->user()->id;
            $pointTask=TaskPoint::where('admin_id',$admin_id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('point');
            $pointMajarerial= Manajerial::where('admin_id',$admin_id)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('poin');


            return view('dashboard.user', compact('pointTask','pointMajarerial'));
        }
    }
}
