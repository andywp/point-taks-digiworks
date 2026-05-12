<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
        return view('admin.brand.index');
    }

    public function create(){
        return view('admin.brand.create');
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'brand'=> 'required|unique:brands,brand',
            //'start_date'=> 'required',
        ]);

        Brand::create([
            'brand' => $request->brand,
            //'start_date' => $request->start_date,
           // 'publish' => $request->publish,
        ]);

        return redirect()->route('admin.brand.index')->with('success','Successfully added brand data');
    }

    public function data(Request $request){
        if($request->ajax()) {
            $datas=Brand::orderBy('id','DESC');
            return DataTables::of($datas)
                ->addColumn('action', function($row){  
                    $btn = '
                            <form id="fd'.$row->id.'" action="'.route('admin.brand.destroy',$row->id).'" method="POST">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="d-flex">
                                    <a href="'.route('admin.brand.edit',$row->id).'" data-id="'.$row->id.'" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-primary shadow btn-xs sharp me-1" ><i class="fas fa-pencil-alt"></i></a>
                                    <button  type="button" data-id="'.$row->id.'" data-name="'.$row->brand.'" data-toggle="tooltip"  data-original-title="Delete" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <div>
                            </form>
                            ';
                    return $btn;
                })
               /*  ->editColumn('publish', function($row) {
                    $checked=($row->publish == 1)?'checked':'';
                    return'<input type="checkbox" name="publish" value="1" '.$checked.' data-id="'.$row->id.'" class="togglepublish"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="xs" data-width="70">';
                })  */
                ->rawColumns(['action','publish']) 
                ->escapeColumns() 
                ->toJson();
        
        }
    }

    public function edit($id){
        $id=(int) $id;
        $data=Brand::find($id);
        if(!$data){
            return abort(404);
        }

        return view('admin.brand.edit',compact('data'));
    }

    public function update($id,Request $request){
        $id=(int) $id;
        $request->validate([
            'brand'=> 'required|unique:brands,brand,'.$id,
            //'start_date'=> 'required',
        ]);

        Brand::find($id)->update([
            'brand' => $request->brand,
            //'start_date' => $request->start_date,
            //'publish' => $request->publish,
        ]);

        return redirect()->route('admin.brand.index')->with('success','Successfully Updated brand data');
    }

    public function publish(Request $request){
        $id      = (int) $request->id;
        $publish = (int) $request->publish;

        $data=Brand::find($id);
        $data->publish =$publish;
        
        $data->save();

        $pesan='successfully activated the brand';
        if($publish == 0){
            $pesan='successfully deactivated the brand';
        }

        $response=[
            'error' => false,
            'pesan' => $pesan
        ];

        return response()->json($response);
    }

    public function destroy($id){
        $id=(int) $id;
        Brand::find($id)->delete();
        return redirect()->route('admin.brand.index')->with('success','Successfully Delete brand data');
    }

}
