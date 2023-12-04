<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $bannerRecords=[
            ['id'=>1,'image'=>'slider1.png','type'=>'slider','link'=>'','title'=>'t-shirt collections','alt'=>'t-shirt collections','sort'=>1,'status'=>1],
            ['id'=>2,'image'=>'slider2.png','type'=>'slider','link'=>'','title'=>'t-shirt collections','alt'=>'t-shirt collections','sort'=>2,'status'=>1],
            ['id'=>3,'image'=>'slider3.png','type'=>'slider','link'=>'','title'=>'t-shirt collections','alt'=>'t-shirt collections','sort'=>3,'status'=>1],
            ['id'=>4,'image'=>'slider4.png','type'=>'slider','link'=>'','title'=>'t-shirt collections','alt'=>'t-shirt collections','sort'=>4,'status'=>1],
        ];
        Banner::insert($bannerRecords);
    }
}
