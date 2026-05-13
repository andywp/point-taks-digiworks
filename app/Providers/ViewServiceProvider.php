<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Admin;
use Carbon\Carbon;
use App\Models\TaskPoint;
use App\Models\Manajerial;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //dd(Auth::guard('admin')->id());
        View::composer('includes.header', function ($view) {
            $userID=Auth::guard('admin')->id() ?? 0;
            $user=Admin::find($userID);

            $now = Carbon::now();
            $bulan=$now->month;
            $year=$now->year;
           // dd($user);
            $htmlPoint='';
            if($user->role == 'Creative'){
                $point_teknis=TaskPoint::where('admin_id',$userID)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('point');
                $point_manajerial=Manajerial::where('admin_id',$userID)->whereMonth('tanggal',$bulan)->whereYear('tanggal',$year)->sum('poin');
                $totalPoint=$point_teknis + $point_manajerial;
                $htmlPoint=' <a href="#" class="dropdown-item ai-icon">
                               <span class="text-danger"><i class="fas fa-use"></i></span> <span class=ms-2"">'.ucwords($user->name).' ('.$totalPoint.')</span> 
                            </a>';
            }
            
            $view->with('htmlPoint', $htmlPoint);

        });
    }
}
