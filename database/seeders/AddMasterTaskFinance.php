<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterTask;

class AddMasterTaskFinance extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=$this->data();
        //dd($data);
        foreach($data as $r){
            if(!MasterTask::where('pekerjaan',$r['pekerjaan'])->count()){

                MasterTask::create([
                    'pekerjaan' => $r['pekerjaan'],
                    'point_type' => 0,
                    'per_hari' => $r['per_hari'],
                    'point_per_10' => $r['point_per_10'],
                    'devisi' => 'Finance',
                    'status' => 1,
                ]);
            }
        }

    }

    private function data()
    {

        $data = [
            [
                'pekerjaan' => 'Transaksi Pemasukan/Pengeluaran Di Template Keuangan',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Input Artikel Baru Di Template Keuangan',
                'point_per_10' => 1,
                'per_hari' => 10,
            ],
            [
                'pekerjaan' => 'Invoice Penagihan Klien - Konfirmasi Omset & Perhitungan',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Pembuatan Invoice Tagihan Klien',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Transfer Dana',
                'point_per_10' => 0.3,
                'per_hari' => 3,
            ],
            [
                'pekerjaan' => 'Perhitungan Fee Partnership & Grup Bisnis',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Pembuatan Purchase Order Per Brand Per Artikel Per Size',
                'point_per_10' => 0.1,
                'per_hari' => 1,
            ],
            [
                'pekerjaan' => 'Pembuatan Rekap Penjualan Brand',
                'point_per_10' => 6,
                'per_hari' => 60,
            ],
            [
                'pekerjaan' => 'Closing Transaksi Aspire',
                'point_per_10' => 6,
                'per_hari' => 60,
            ],
            [
                'pekerjaan' => 'Rekap Transaksi Aspire Per Brand Per Transaksi',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Penarikan Saldo Marketplace Per Brand Per Channel',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Rekap Inventory Brand Retail Per Brand',
                'point_per_10' => 2,
                'per_hari' => 20,
            ],
            [
                'pekerjaan' => 'Tarik Data Omset Brand Retail Per Brand Per Channel',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Perhitungan Fee Operasional Brand Retail Per Brand',
                'point_per_10' => 1.5,
                'per_hari' => 15,
            ],
            [
                'pekerjaan' => 'Pembuatan Rekap HPP (poin) Per Brand',
                'point_per_10' => 3,
                'per_hari' => 30,
            ],
            [
                'pekerjaan' => 'Pembuatan Laporan Keuangan Versi Pajak Per Brand Retail',
                'point_per_10' => 6,
                'per_hari' => 60,
            ],
            [
                'pekerjaan' => 'Pembuatan Billing Pajak Per Brand',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Pembuatan Rekap Perbandingan Omset Brand VS Digiworks',
                'point_per_10' => 1,
                'per_hari' => 10,
            ],
            [
                'pekerjaan' => 'Pembuatan Laporan Proyeksi Mingguan',
                'point_per_10' => 4,
                'per_hari' => 40,
            ],
            [
                'pekerjaan' => 'Pembuatan Laporan Bulanan Gabungan Digiworks',
                'point_per_10' => 116,
                'per_hari' => 1160,
            ],
            [
                'pekerjaan' => 'Pembuatan Laporan Keuangan Versi Pajak Per Corporate',
                'point_per_10' => 18,
                'per_hari' => 180,
            ],
            [
                'pekerjaan' => 'Pembuatan Laporan Laba Rugi Brand Retail Per Brand',
                'point_per_10' => 12,
                'per_hari' => 120,
            ],
            [
                'pekerjaan' => 'Pembuatan Rekap BPJS Ketenagakerjaan Karyawan Per Corporate',
                'point_per_10' => 1.5,
                'per_hari' => 15,
            ],
            [
                'pekerjaan' => 'Pembuatan Rekap & Laporan Tahunan Per Corporate',
                'point_per_10' => 6,
                'per_hari' => 60,
            ],
            [
                'pekerjaan' => 'Pembuatan Rekap & Laporan Bonus Karyawan All Digiworks',
                'point_per_10' => 6,
                'per_hari' => 60,
            ],
            [
                'pekerjaan' => 'Pembuatan Rekap & Laporan SPT Masa',
                'point_per_10' => 1.5,
                'per_hari' => 15,
            ],
            [
                'pekerjaan' => 'Pembuatan Template PO',
                'point_per_10' => 24,
                'per_hari' => 240,
            ],
            [
                'pekerjaan' => 'Penarikan Data dari Shopee untuk Purchase Order',
                'point_per_10' => 0.05,
                'per_hari' => 0.5,
            ],
            [
                'pekerjaan' => 'Pembuatan Perbandingan Data SO Badudu',
                'point_per_10' => 6,
                'per_hari' => 60,
            ],
            [
                'pekerjaan' => 'Pembuatan Template Inventory Badudu',
                'point_per_10' => 6,
                'per_hari' => 60,
            ],
            [
                'pekerjaan' => 'Revisi Inventory Badudu (Cek Inventory Badudu, waktu 10 Menit)',
                'point_per_10' => 1,
                'per_hari' => 10,
            ],
            [
                'pekerjaan' => 'Laporan NPM Berdasarkan Omset Tarikan Per Brand',
                'point_per_10' => 3,
                'per_hari' => 30,
            ],
            [
                'pekerjaan' => 'Rekap Penggunaan Iklan Brand Sesuai Request AE (Monit) Per Bulan',
                'point_per_10' => 0.5,
                'per_hari' => 5,
            ],
            [
                'pekerjaan' => 'Approval Payment Iklan Brand per Payment',
                'point_per_10' => 0.2,
                'per_hari' => 2,
            ],
            [
                'pekerjaan' => 'Input Data Pengiriman Barang per Produk',
                'point_per_10' => 0.05,
                'per_hari' => 0.5,
            ],
            [
                'pekerjaan' => 'Rekap Penjualan Per Pesanan',
                'point_per_10' => 3,
                'per_hari' => 30,
            ],
            [
                'pekerjaan' => 'Input Penjualan Perhari ( berdasarkan barang dikirim )',
                'point_per_10' => 0.05,
                'per_hari' => 0.5,
            ],
            [
                'pekerjaan' => 'Transaksi Pemasukan/Pengeluaran Di Template Keuangan Stock Plus',
                'point_per_10' => 0.3,
                'per_hari' => 3,
            ],
        ];
        
        return $data;
    }
}
