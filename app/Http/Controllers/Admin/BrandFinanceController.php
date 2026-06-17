<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\BrandFinance;

class BrandFinanceController extends Controller
{
    public function index(){
        $brand=Brand::orderBy('brand','ASC')->get();
        $brand_finance=BrandFinance::pluck('brand_id')->toArray();
        //dd($brand_finance[0]);

        return view('admin.setting.finance.brand',compact('brand','brand_finance'));
    }

    public function update(Request $request){
        $brands = array_unique($request->brand ?? []);
        //dd($brands,$request->brand);
        BrandFinance::truncate();
        foreach($brands as $r){
            BrandFinance::create([
                                'brand_id' =>  $r,
                                ]);
        }

        return redirect()->back()->with('success','Successfully manage brand');

    }
}
