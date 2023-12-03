<?php

namespace Database\Seeders;

use App\Models\Cmspage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmspageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cmspagerecords=[
            ['id'=>2,'title'=>'about us','description'=>'content is comming soon','url'=>'about-us','meta_title'=>'about us','meta_descriptions'=>'about us content','meta_keywords'=>'about us about','status'=>1],
            ['id'=>3,'title'=>'about us','description'=>'content is comming soon','url'=>'about-us','meta_title'=>'about us','meta_descriptions'=>'about us content','meta_keywords'=>'about us about','status'=>1],
            ['id'=>4,'title'=>'about us','description'=>'content is comming soon','url'=>'about-us','meta_title'=>'about us','meta_descriptions'=>'about us content','meta_keywords'=>'about us about','status'=>0]
        ];
        Cmspage::insert($cmspagerecords);
    }
}
