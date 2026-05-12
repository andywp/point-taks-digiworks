<?php
/** Halper
 *  Author : Andi Wijang prasetyo
 *  Email : Andy.wijang@gmail.com
 * 
 */
use Kudashevs\ShareButtons\Facades\ShareButtonsFacade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

function activeRoute($route, $isClass = false): string
{
    $requestUrl = request()->is($route);
    
    if($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}

/**
 * route('dashboard.1') for url condition
 * 'dashboard.1' for getName condition
 */
function activeRouteName($route, $isClass = false): string
{ 
    // $requestUrl = request()->url() === $route
    $requestUrl = request()->routeIs($route);

    if ($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}


/**
 * get image profile from email
 * 
 */

function get_gravatar($email='', $s = 200, $d = 'mp', $r = 'g', $img = false, $atts = []) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";

    if ($img) {
        $url = '<img src="' . $url . '"';

        foreach ($atts as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }

        $url .= ' />';
    }

    return $url;
}


function assetVersion()
{
	return \Config::get('asset_version.version');
}


function setRupiah( $price){

    return  @number_format((int) $price,0,',','.');
}


function FormatRupiah($price=null,$decimal=0){
    if($price){
    return  @number_format($price,$decimal,',','.');
    }

    return 0;
}


function FormatAngkaBadge($price,$decimal=0,$prefix=''){
    $prefix=$prefix !=''?$prefix.' ':'';
    if($price < 0 ){
        return '<span class="badge light badge-danger">'.$prefix.FormatRupiah($price,$decimal).'</span>';
    }else{
         return $prefix.FormatRupiah($price,$decimal);
    }
}


function Bulan(){
    $bulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '09' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    return $bulan;
}

function getLastDay($data){
    $data=explode('-',$data);
    $bulan=$data[0];
    $tahun=$data[1];
    return Carbon::create($tahun, $bulan, 1)->endOfMonth()->translatedFormat('d');
}


function getPeriodeTitle($data){

    $day=getLastDay($data);
    $data=explode('-',$data);
    $bulan=$data[0];
    $tahun=$data[1];
    $month=Bulan($bulan);

    return $day.' '.$month.' '.$tahun;
}


function TitleRugiLaba(){
    return ['PENDAPATAN','PENDAPATAN RETAIL','PENDAPATAN BERSIH','PENDAPATAN USAHA LAINNYA','PENGURANG PENDAPATAN','LABA KOTOR','BEBAN TENAGA KERJA','BEBAN MARKETING','BEBAN ADMINISTRASI DAN UMUM','BEBAN UTILITY & MAINTENANCE','JUMLAH BEBAN OPERASI','LABA OPERASI','BEBAN PENYUSUTAN','BEBAN LAIN-LAIN','JUMLAH BEBAN NON OPERASI','LABA BERSIH','Beban Pajak','LABA BERSIH SETELAH PAJAK'];
}

function TitleArusKas(){
    return ['ARUS KAS DARI AKTIVITAS OPERASI','PENYESUAIAN-PENYESUAIAN','ARUS KAS DARI AKTIVITAS INVESTASI','ARUS KAS DARI AKTIVITAS PENDANAAN','KENAIKAN & PENURUNAN'];
}

function footerArusKas(){
    return ['Jumlah Arus Kas dari Aktivitas Pendanaan','Kenaikan Bersih Kas dan Setara Kas','Penurunan Bersih Kas dan Setara Kas','Kas dan Setara Kas pada Awal Periode','Kas dan Setara Kas pada Akhir Periode'];
}