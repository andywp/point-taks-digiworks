<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use DataTables;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Controller
{
    public function index(){

        return view('admin.user.index');
    }

    public function dataTable(Request $request){
        if($request->ajax()) {
            //dd(auth('admin')->user()->id);
                $datas = Admin::select('*')->where('role','!=','developer')->where('id','!=',auth('admin')->user()->id);
                return DataTables::of($datas)
                ->addColumn('action', function($row){  
                    $btn = '
                            <form id="fd'.$row->id.'" action="'.route("admin.user.destroy",['id' => $row->id]).'" method="POST">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                <input type="hidden" name="_method" value="DELETE">
                                <div class="d-flex">
                                    <button  type="button"  data-id="'.$row->id.'" 
                                                            data-name="'.$row->name.'"
                                                            data-role="'.$row->role.'"
                                                            data-email ="'.$row->email.'"
                                                            data-username  ="'.$row->username.'"
                                                            
                                                            data-toggle="tooltip"  data-original-title="Edit"  class="edit btn btn-primary shadow btn-xs sharp me-1" ><i class="fas fa-pencil-alt"></i></button>
                                    <button  type="button" data-id="'.$row->id.'" data-name="'.$row->name.'" data-toggle="tooltip"  data-original-title="Delete" class="delete btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                <div>
                            </form>
                            ';
                    return $btn;
                })
                 ->editColumn('gaji', function($row){
                    return ($row->gaji != '')?setRupiah($row->gaji):'';
                })
                ->addColumn('password', function($row){
                    return '<button  type="button"  
                    data-id="'.$row->id.'" 
                    data-nip="'.$row->nip.'" 
                    data-name="'.$row->name.'"
                    data-type="'.$row->type_user.'"
                    data-email ="'.$row->email.'"
                    data-username  ="'.$row->username.'"
                    
                    data-bs-toggle="tooltip"  data-original-title="Edit"  class="password btn btn-info shadow btn-xs  me-1" >Change</button>';
                }) 
                /* ->editColumn('active', function($row) {
                    $checked=($row->active == 1)?'checked':'';
                    return'<input type="checkbox" name="publish" value="1" '.$checked.' data-id="'.$row->id.'" class="togglepublish"  data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="xs" data-width="70">';
                }) */
                ->rawColumns(['action','active','password'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->orderColumn('name',function ($query, $order) {
                    $query->orderBy('id', $order);
                })
                ->toJson(); 
            }
    }

    public function store(Request $request,Admin $User){
        $validator=array();
        $validator['name']='required|max:255';
        $validator['email']='required|email:rfc,dns|unique:admins,email';
        $validator['username']='min:3|max:255|required|unique:admins,username';
        $validator['password']='required|min:6|max:255';
        $validator['role']='required';
        if($request->role != 'Admin'){
            $validator['gaji']='required|numeric|min:1';
        }

        $request->validate($validator);

        //dd($request->All());
        $input=[
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'  =>  $request->role
        ];
        if($request->role != 'Admin'){
            $input['gaji']=$request->gaji;
        }

        $User::create($input);
        return response()->json(['success'=> 'success add users']);
    }

    public function update(Request $request,Admin $User){
        $validator=array();
        $validator['name']='required|max:255';
        $validator['email']='required|email:rfc,dns|unique:admins,email,'.$request->id;
        $validator['username']='min:3|max:255|required|unique:admins,username,'.$request->id;
        //$validator['password']='required|min:6|max:255';
        $validator['role']='required';

        if($request->role != 'Admin'){
            $input['gaji']=$request->gaji;
        }

        $request->validate($validator);



        $input=[
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role'  =>  $request->role
        ];

        if($request->role != 'Admin'){
            $input['gaji']=$request->gaji;
        }

        
        $user=$User::find($request->id);
        $user->update($input);
        return response()->json(['success'=> 'success Update users']);
    }

    public function password(Request $request,Admin $User){
        $request->validate([
            'password'      => 'required|min:6|max:255',
        ]);
        $input=[
            'password' => Hash::make($request->password),
        ];
        $user=$User::find($request->id);
        $user->update($input);
        return response()->json(['success'=> 'success Update users']);
    }

    /**delete */
    public function destroy($id,Request $request,Admin $User){
        $User::find($id)->delete();
        return redirect()->route('admin.user.index')
                ->with('success','Delete successfully');
    }
}
