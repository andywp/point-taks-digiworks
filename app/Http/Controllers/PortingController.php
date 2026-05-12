<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\MasterTask;
use App\Models\TaskPoint;
use Illuminate\Support\Facades\DB;


class PortingController extends Controller
{
    public function index(){
        $data=DB::table('fazril')->orderBy('id','ASC')->get();
        //dd($data);
        $task=array();
        foreach($data as $r){
            $brand_id =Brand::whereLike('brand',trim($r->Brand))->value('id');

            $masterTask=MasterTask::where('pekerjaan',trim($r->Pekerjaan))->first();

            $point=0;
            if($r->Output !=''){
                $pointMaster=(float) $masterTask->point_per_10;
                    //dd((float) $perSepuluhMenit);
                $point=round($pointMaster * $r->Output);
            }

            $input=array();
            $input['admin_id']=$r->admin_id;
            $input['tanggal']=$r->Tanggal;
            $input['brand_id']=$brand_id;
            $input['master_tasks_id']=$masterTask->id;
            $input['task']=$masterTask->pekerjaan;
            $input['point']=$point;
            $input['output']=($r->Output =! '')?$r->Output:0;

            $task[]= $input;

           TaskPoint::create($input);
        }
        //dd($task);
        dd('ok');

    }
}
