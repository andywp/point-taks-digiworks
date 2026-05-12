<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Manajerial;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;


class ManajerialController extends Controller
{
    public function index(){
        $brand=Brand::orderBy('brand','ASC')->get();
        return view('creative.manajerial.index',compact('brand'));
    }

    public function create(){
        $brand=Brand::orderBy('brand','ASC')->get();
        //dd($master);
        return view('creative.manajerial.create',compact('brand'));
    }

    public function store(Request $request){
        $admin_id=auth('admin')->user()->id;
        //dd($admin_id);
        $request->validate([
            'brand'=> 'required',
            'job'=> 'required',
            'tanggal'=> 'required',
            'persentase' => 'required|numeric|min:1',
        ]);

        $admin_id=auth('admin')->user()->id;

       

        $point= round(($request->persentase / 100) * 522);
        // dd($request->all(),$point);
    
        Manajerial::create([
            'admin_id' =>  $admin_id,
            'brand_id' =>  $request->brand,
            'tanggal' =>  $request->tanggal,
            'job' =>  $request->job,
            'persentase' =>  $request->persentase,
            'poin' =>  $point,
            
        ]);
        return redirect()->back()->with('success','Successfully added manajerial');
    }

    public function data(Request $request){
        if($request->ajax()) {
            $admin_id=auth('admin')->user()->id;
            $reqTanggal=$request->tanggal;
            $date = explode('-', $reqTanggal);
            $start = Carbon::createFromFormat('d/m/Y', trim($date[0]))->format('Y-m-d');
            $end   = Carbon::createFromFormat('d/m/Y', trim($date[1]))->format('Y-m-d');
            $datas=Manajerial::with('brand')->where('admin_id', $admin_id)->whereBetween('tanggal',[$start, $end])->orderBy('tanggal','DESC')->orderby('id','DESC');

            if($request->brand !=''){
                $datas->where('brand_id',$request->brand);
            }
            return DataTables::of($datas)
                ->editColumn('tanggal', function($row){
                    return Carbon::parse($row->tanggal)->translatedFormat('d F Y');
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
                ->rawColumns(['action']) 
                ->escapeColumns() 
                ->toJson();
        
        }
    }
}
