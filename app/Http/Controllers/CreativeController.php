<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MasterTask;
use App\Models\TaskPoint;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;


class CreativeController extends Controller
{
    public function index(){

        $brand=Brand::orderBy('brand','ASC')->get();
        $master=MasterTask::orderBy('pekerjaan','asc')->get();
        return view('creative.task.index',compact('master','brand'));
    }

    public function create(){
        $brand=Brand::orderBy('brand','ASC')->get();
        $master=MasterTask::orderBy('pekerjaan','ASC')->get();
        //dd($master);
        return view('creative.task.create',compact('brand','master'));
    }

    public function store(Request $request){
        $admin_id=auth('admin')->user()->id;
        //dd($request->all());
        //dd($admin_id);
       /*  $request->validate([
            'brand'=> 'required',
            'pekerjaan'=> 'required',
            'tanggal'=> 'required',
            'output' => 'required|numeric|min:1',
        ]); */

        $brand = $request->brand;
        $pekerjaan = $request->pekerjaan;
        $tanggal = $request->tanggal;
        $output = $request->output;
        $note = $request->note;
        $admin_id=auth('admin')->user()->id;

        foreach ($brand as $i => $value) {

            $masterPekerjaanId=$pekerjaan[$i];
            $perSepuluhMenit=MasterTask::where('id',$masterPekerjaanId)->value('point_per_10');
            $pointMaster=(float) $perSepuluhMenit;
            //dd((float) $perSepuluhMenit);
            $point=$pointMaster * $output[$i];

            $task=MasterTask::where('id',$masterPekerjaanId)->value('pekerjaan');
            TaskPoint::create([
                'admin_id' =>  $admin_id,
                'brand_id' =>  $brand[$i],
                'master_tasks_id' => $masterPekerjaanId,
                'task' =>  $task,
                'tanggal' =>  $tanggal[$i],
                'output' =>  $output[$i],
                'point' =>  $point,
                'note' =>  $note[$i],
            ]);
        }


        
        return redirect()->back()->with('success','Successfully added task');
    }

    public function edit($id){
        $id=(int) $id;

        $data=TaskPoint::find($id);
        if(!$data){
            return abort(404);
        }
        //dd($data);
        $brand=Brand::orderBy('brand','ASC')->get();
        $master=MasterTask::orderBy('pekerjaan','ASC')->get();
        //dd($master);
        return view('creative.task.edit',compact('data','brand','master'));

    }

    public function update($id,Request $request){
        $request->validate([
            'brand'=> 'required',
            'pekerjaan'=> 'required',
            'tanggal'=> 'required',
            'output' => 'required|numeric|min:1',
        ]);
        $id= (int) $id;

        $perSepuluhMenit=MasterTask::where('id',$request->pekerjaan)->value('point_per_10');
        $pointMaster=(float) $perSepuluhMenit;
        //dd((float) $perSepuluhMenit);
        $point=$pointMaster * $request->output;
        $task=MasterTask::where('id',$request->pekerjaan)->value('pekerjaan');

        TaskPoint::find($id)->update([
            'brand_id' =>  $request->brand,
            'master_tasks_id' =>  $request->pekerjaan,
            'task' =>  $task,
            'tanggal' =>  $request->tanggal,
            'output' =>  $request->output,
            'point' =>  $point,
            'note' =>   $request->note,
        ]);

         return redirect()->back()->with('success','Successfully Update task');
    }

    public function data(Request $request){
        if($request->ajax()) {
            $admin_id=auth('admin')->user()->id;
            $reqTanggal=$request->tanggal;
            $date = explode('-', $reqTanggal);
            $start = Carbon::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d');
            $end   = Carbon::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d');

            $datas=TaskPoint::with(['brand','masterTask'])->where('admin_id', $admin_id)->whereBetween('tanggal',[$start, $end])->orderBy('tanggal','DESC')->orderby('id','DESC');
            if($request->task !=''){
                $datas->where('master_tasks_id',$request->task);
            }

            if($request->brand !=''){
                $datas->where('brand_id',$request->brand);
            }
            return DataTables::of($datas)
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->tanggal)->translatedFormat('d F Y');
                })
                ->editColumn('task', function($row){
                    $color=$row->masterTask->color;
                    $style=!empty($color)?'style="background:'.$color.';"':'';

                    return '<span '. $style.' >'.$row->task.'</span>';
                })
                ->addColumn('brand', function($row){
                    return $row->brand->brand ?? '-';
                })
                ->addColumn('action', function($row){  
                    $btn = '
                            <form id="fd'.$row->id.'" action="'.route('admin.task.destroy',$row->id).'" method="POST">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="d-flex">
                                    <a href="'.route('admin.task.edit',$row->id).'" data-id="'.$row->id.'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary shadow btn-xs sharp me-1" ><i class="fas fa-pencil-alt"></i></a>
                                    <button  type="button" data-id="'.$row->id.'" data-name="'.$row->pekerjaan.'" data-toggle="tooltip"  data-original-title="Delete" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <div>
                            </form>
                            ';
                    return $btn;
                })
                ->rawColumns(['action','task']) 
                ->escapeColumns() 
                ->toJson();
        
        }
    }

    public function destroy($id){
        TaskPoint::find($id)->delete();
        return redirect()->back()->with('success','Successfully Delete');
    }

}
