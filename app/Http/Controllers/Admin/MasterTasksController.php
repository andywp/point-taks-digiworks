<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterTask;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class MasterTasksController extends Controller
{
    public function index(){
        return view('admin.master_task.index');
    }

    public function store(Request $request){
        $request->validate([
            'pekerjaan'=> 'required',
            'point_type'=> 'required|in:0,1',
            'point' => 'required|numeric|min:1',
        ]);
        //dd($request->all());

        $input=array();
        $input['pekerjaan']=$request->pekerjaan;
        $input['point_type']=$request->point_type;
        $input['per_hari']=0;
        $input['per_bulan']=0;
        if($request->point_type == 0){
            $input['per_hari']=$request->point;
            $menit_per_output=$this->potinHarian($request->point);
            $input['menit_per_output']= $menit_per_output;
            $input['point_per_10']= round($menit_per_output / 10 ,1);
        }else{
            $input['per_bulan']=$request->point;
            $menit_per_output=$this->pointBulanan($request->point);
            $input['menit_per_output']= $menit_per_output;
            $input['point_per_10']= round($menit_per_output / 10 ,1);
        }

        MasterTask::create($input);
        return redirect()->back()->with('success','Successfully added');
    }


    public function potinHarian(int $nilai){
        return round((7*60)/$nilai,1);
    }

    public function pointBulanan(int $nilai){
        return round( (((7*60) * 22 ) + ( (5*60) * 4)) / $nilai,1); 
    }

    public function data(Request $request){
        if($request->ajax()) {
            $datas=MasterTask::orderBy('id','DESC');
            return DataTables::of($datas)
                ->addColumn('action', function($row){  
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

    public function edit($id){
        $id=(int)$id;
        $data=MasterTask::find($id);
        if(!$data){
            return abort(404);
        }
        return view('admin.master_task.edit',compact('data'));
    }

    public function update($id, Request $request){
        $request->validate([
            'pekerjaan'=> 'required',
            'point_type'=> 'required|in:0,1',
            'point' => 'required|numeric|min:1',
        ]);

        $id=(int)$id;
        $data=MasterTask::find($id);
        if(!$data){
            return abort(404);
        }
        //dd($request->all());

        $input=array();
        $input['pekerjaan']=$request->pekerjaan;
        $input['point_type']=$request->point_type;
        $input['per_hari']=0;
        $input['per_bulan']=0;
        if($request->point_type == 0){
            $input['per_hari']=$request->point;
            $menit_per_output=$this->potinHarian($request->point);
            $input['menit_per_output']= $menit_per_output;
            $input['point_per_10']= round($menit_per_output / 10 ,1);
        }else{
            $input['per_bulan']=$request->point;
            $menit_per_output=$this->pointBulanan($request->point);
            $input['menit_per_output']= $menit_per_output;
            $input['point_per_10']= round($menit_per_output / 10 ,1);
        }

        MasterTask::find($id)->update($input);
        return redirect()->back()->with('success','Successfully update data');
    }

    public function destroy($id){
        $id=(int) $id;
        MasterTask::find($id)->delete();
        return redirect()->back()->with('success','Successfully Delete');
    }


    public function porting(){
       /* $data=DB::table('master')->get();
        //dd($data);

        foreach($data as $request){
            $input=array();
            $input['pekerjaan']=$request->pekerjaan;
            $input['point_type']=$request->point_type;
            $input['per_hari']=0;
            $input['per_bulan']=0;
            if($request->point_type == 0){
                $input['per_hari']=$request->per_hari;
                $menit_per_output=$this->potinHarian($request->per_hari);
                $input['menit_per_output']= $menit_per_output;
                $input['point_per_10']= round($menit_per_output / 10 ,1);
            }else{
                $input['per_bulan']=$request->per_bulan;
                $menit_per_output=$this->pointBulanan($request->per_bulan);
                $input['menit_per_output']= $menit_per_output;
                $input['point_per_10']= round($menit_per_output / 10 ,1);
            }

           MasterTask::create($input);

        }


        dd('OK'); */
    }




}
