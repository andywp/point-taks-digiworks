<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\TaskPoint;
use App\Models\MasterTask;

use App\Models\Manajerial;
use Yajra\DataTables\DataTables;

class SummaryController extends Controller
{
    public function index(Request $request){

        return view('admin.summary.index');
    }

    public function data(Request $request){
        $data=array();
        $user=Admin::where('role','Creative')->orderBy('name','ASC')->get();


        //if ($request->tanggal != '') {
            $date = explode('-', $request->tanggal);
            $start = Carbon::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d');
            $end   = Carbon::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d');
            //$datas->whereBetween(DB::raw('DATE(created_at)'), [$start, $end]);

             //dd($start,$end);
        //}
        //dd($user);
        foreach($user as $r){
            $point_teknis = TaskPoint::where('admin_id',$r->id)->whereBetween('tanggal',[$start, $end])->sum('point');
            $point_manajerial = Manajerial::where('admin_id',$r->id)->whereBetween('tanggal',[$start, $end])->sum('poin');
            $UnderPoint=0;
            /* if($total > 1044){
                $UnderPoint=$total-1044;
            } */

            /* $manajerial_under=0;
            if($totalMajerial > 1044){
                $manajerial_under=$totalMajerial-1044;
            } */

            /* $takeHomePay=0;
            $global=$UnderPoint + $manajerial_under;
            if($global > 0){
                $takeHomePay=($r->gaji / 1044) * $global; 
            } */
           
            $total_poin=$point_teknis + $point_manajerial;

            $total_over_point=0;
            if($total_poin > 1044){
                $total_over_point = $total_poin - 1044;
            }

            $take_home_pay=$r->gaji;
            if($total_over_point > 0){
                $take_home_pay=($r->gaji / 1044) * $total_over_point;
                $take_home_pay=$r->gaji + $take_home_pay;
            }


            $data[]=[
                'user_id' => $r->id,
                'nama' => $r->name,
                'point_teknis' => $point_teknis,
                'point_manajerial' => $point_manajerial,
                'total_poin' => $total_poin,
                'total_over_point' => $total_over_point,
                'take_home_pay' => setRupiah(round($take_home_pay))
            ];
            
        }
        
        $data=collect($data);
        return DataTables::of($data)
                   /*  ->addColumn('status', function ($row) {
                        return $row['umur'] > 27 ? 'Tua' : 'Muda';
                    }) */
                    ->make(true);
    }


    public function user(Request $request){
        $user=Admin::where('role','Creative')->orderBy('name','ASC')->get();
        $brand=Brand::orderBy('brand','ASC')->get();
        $masterTask=MasterTask::orderBy('pekerjaan','asc')->get();
        return view('admin.summary.user', compact('masterTask','user','brand'));
    }

    public function data_summary_user(Request $request){
        if($request->ajax()) {
            
            $reqTanggal=$request->tanggal;
            $date = explode('-', $reqTanggal);
            $start = Carbon::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d');
            $end   = Carbon::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d');

            $dataz=TaskPoint::with(['brand','admin','masterTask'])->whereBetween('tanggal',[$start, $end]);
            if($request->task !=''){
                $dataz->where('master_tasks_id',$request->task);
            }

            if($request->user !=''){
                $dataz->where('admin_id',$request->user);
            }

            if($request->brand !=''){
                $dataz->where('brand_id',$request->brand);
            }


            return DataTables::of($dataz)
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->tanggal)->translatedFormat('d F Y');
                })
                ->addColumn('action', function($row){  
                    //dd($row);
                    $btn = '
                            <form id="fd'.$row->id.'" action="'.route('admin.master_task.destroy',$row->id).'" method="POST">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="d-flex">
                                    <a href="'.route('admin.master_task.edit',$row->id).'" data-id="'.$row->id.'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary shadow btn-xs sharp me-1" ><i class="fas fa-pencil-alt"></i></a>
                                    <button  type="button" data-id="'.$row->id.'" data-name="'.$row->pekerjaan.'" data-toggle="tooltip"  data-original-title="Delete" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <div>
                            </form>
                            ';
                    return $btn;
                })
               
                ->rawColumns(['action']) 
                ->escapeColumns() 
                ->toJson();




        }
    }


    public function manajerial(Request $request){
        $user=Admin::where('role','Creative')->orderBy('name','ASC')->get();
        $brand=Brand::orderBy('brand','ASC')->get();
        return view('admin.summary.manajerial',compact('user','brand'));
    }

    public function manajerial_data(Request $request){
        if($request->ajax()) {
            $reqTanggal=$request->tanggal;
            $date = explode('-', $reqTanggal);
            $start = Carbon::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d');
            $end   = Carbon::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d');

            $dataz=Manajerial::with(['brand','admin'])->whereBetween('tanggal',[$start, $end]);
            if($request->user !=''){
                $dataz->where('admin_id',$request->user);
            }

            if($request->brand !=''){
                $dataz->where('brand_id',$request->brand);
            }


            return DataTables::of($dataz)
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->tanggal)->translatedFormat('d F Y');
                })
                ->addColumn('action', function($row){  
                    //dd($row);
                    $btn = '
                            <form id="fd'.$row->id.'" action="'.route('admin.master_task.destroy',$row->id).'" method="POST">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="d-flex">
                                    <a href="'.route('admin.master_task.edit',$row->id).'" data-id="'.$row->id.'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary shadow btn-xs sharp me-1" ><i class="fas fa-pencil-alt"></i></a>
                                    <button  type="button" data-id="'.$row->id.'" data-name="'.$row->pekerjaan.'" data-toggle="tooltip"  data-original-title="Delete" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <div>
                            </form>
                            ';
                    return $btn;
                })
               
                ->rawColumns(['action']) 
                ->escapeColumns() 
                ->toJson();

        }
    }

    public function by_brand(){
        $brand=Brand::orderBy('brand','asc')->get();
        return view('admin.summary.brand',compact('brand'));
    }

    public function by_brand_data(Request $request){
        $reqTanggal=$request->tanggal;
        $date = explode('-', $reqTanggal);
        $start = Carbon::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d');
        $end   = Carbon::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d');

        $data=array();
        $brand=Brand::orderBy('brand','ASC');

        if($request->brand !=''){
            $brand->where('id',$request->brand);
        }

        $bands=$brand->get();
        
        $total_devisi=$this->getGajiDevisi($start, $end);
        $total_gaji=$total_devisi['total_take_home_pay'];
        $total_point_devisi=$total_devisi['total_point'];

        foreach($bands as $r){

            $point_teknis=TaskPoint::where('brand_id',$r->id)->whereBetween('tanggal',[$start, $end])->sum('point');
            $point_manajerial=Manajerial::where('brand_id',$r->id)->whereBetween('tanggal',[$start, $end])->sum('poin');
            $total_point=$point_teknis + $point_manajerial;

            $value_point=$total_point * ($total_gaji / $total_point_devisi);
            $value_point=round($value_point);
            $data[]=[
                'id' => $r->id,
                'devisi' => 'Creative',
                'brand' => $r->brand,
                'point_teknis' => $point_teknis,
                'point_manajerial' => $point_manajerial,
                'point_total' => $total_point,
                'value_point' => setRupiah($value_point),
            ];
        }

        $data=collect($data);
        return DataTables::of($data)->make(true);
    }


    private function getGajiDevisi($start,$end){
        //$start='2026-03-01';
        //$end='2026-03-31';
        $user=Admin::select('id','name','gaji')->where('role','Creative')->orderBy('name','ASC')->get();
        //dd($user);
        $totalGaji=0;
        $total_poit_devisi=0;
        foreach($user as $r){
            $point_teknis = TaskPoint::where('admin_id',$r->id)->whereBetween('tanggal',[$start, $end])->sum('point');
            $point_manajerial = Manajerial::where('admin_id',$r->id)->whereBetween('tanggal',[$start, $end])->sum('poin');
            $UnderPoint=0;
            
           
            $total_poin=$point_teknis + $point_manajerial;

            $total_over_point=0;
            if($total_poin > 1044){
                $total_over_point = $total_poin - 1044;
            }

            $take_home_pay=$r->gaji;
            if($total_over_point > 0){
                $take_home_pay=($r->gaji / 1044) * $total_over_point;
                $take_home_pay=$r->gaji + $take_home_pay;
            }

            $total_poit_devisi +=$total_poin;

            $totalGaji+=$take_home_pay;
        }

        //dd(setRupiah($totalGaji));
        //return($totalGaji);

        return [
            'total_take_home_pay' => $totalGaji,
            'total_point' => $total_poit_devisi,
        ];
    }


}
