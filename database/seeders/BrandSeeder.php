<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=$this->data();
        foreach($data as $r){
            if(!Brand::where('brand',$r)->count()){
                Brand::create([
                    'brand' => $r
                ]);
            }
        }
    }

    private function data(){
        $brands = [
            'Adleeva',
            'Alabel',
            'Anssy',
            'Badudu',
            'Candypops',
            'Cuddie',
            'Diglink',
            'Digiworks',
            'Esclo',
            'Helenic',
            'Idzi',
            'Jglow 01',
            'Jglow 10',
            'JNC Cookies',
            'Johnjill',
            'Junkiee',
            'LNC',
            'Locarom',
            'Mamibelle',
            'Markicabs',
            'Netaly',
            'Neumen',
            'Rafaiz Outfit',
            'Rurik',
            'Santigi',
        ];

        return $brands;
    }


}
