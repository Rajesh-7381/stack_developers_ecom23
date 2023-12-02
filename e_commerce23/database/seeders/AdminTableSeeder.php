<?php

namespace Database\Seeders;

// use App\Http\Middleware\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        //
        $password=Hash::make('123456');
        $adminRecords=[
            ['id'=>1,'name'=>'Admin','type'=>'admin','mobile'=>8937477470,'email'=>"admin@gmail.com",'password'=>$password,'image'=>'','status'=>1],
            ['id'=>3,'name'=>'subadmins','type'=>'subadmins','mobile'=>8937477470,'email'=>"subadmins1@gmail.com",'password'=>$password,'image'=>'','status'=>0],
            ['id'=>4,'name'=>'subadmins','type'=>'subadmins','mobile'=>8937477470,'email'=>"subadmins2@gmail.com",'password'=>$password,'image'=>'','status'=>1],
            ['id'=>5,'name'=>'subadmins','type'=>'subadmins','mobile'=>8937477470,'email'=>"subadmins3@gmail.com",'password'=>$password,'image'=>'','status'=>1],
            ['id'=>6,'name'=>'subadmins','type'=>'subadmins','mobile'=>8937477470,'email'=>"subadmins4@gmail.com",'password'=>$password,'image'=>'','status'=>1],
            ['id'=>7,'name'=>'subadmins','type'=>'subadmins','mobile'=>8937477470,'email'=>"subadmins5@gmail.com",'password'=>$password,'image'=>'','status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
