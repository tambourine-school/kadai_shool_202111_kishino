<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        for ($i = 1; $i <= 100; $i++) {
            DB::table("tasks")->insert([
                "hashed_id" => Str::random(20),
                "plan" => "運動{$i}分",
                "date_do" => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-01 03:45:27')->addDays($i),
                "status" => 0,
                "created_at" => Carbon::now(),
            ]);
        }
        // DB::table("tasks")->insert([
        //     "plan" => "運動30分",
        //     "date_do" => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-01 03:45:27'),
        //     "status" => 0,
        //     "created_at" => Carbon::now(),
        // ]);
        // DB::table("tasks")->insert([
        //     "plan" => "腕立て100回",
        //     "date_do" => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-10 03:45:27'),
        //     "status" => 0,
        //     "created_at" => Carbon::now(),
        // ]);
        // DB::table("tasks")->insert([
        //     "plan" => "腹筋100回",
        //     "date_do" => Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-20 03:45:27'),
        //     "status" => 0,
        //     "created_at" => Carbon::now(),
        // ]);
        // DB::table("tasks")->insert([
        //     "plan" => "朝に運動をする",
        //     "date_do" => Carbon::createFromFormat('Y-m-d H:i:s', '2021-11-10 03:45:27'),
        //     "status" => 1,
        //     "check" => "時間を決めたのがよかった",
        //     "action" => "質を重視したトレーニングにする",
        //     "created_at" => Carbon::now(),
        // ]);
        // DB::table("tasks")->insert([
        //     "plan" => "運動をする",
        //     "date_do" => Carbon::createFromFormat('Y-m-d H:i:s', '2019-11-01 13:45:27'),
        //     "status" => 2,
        //     "check" => "飲み会に誘われた",
        //     "action" => "朝に運動をする",
        //     "created_at" => Carbon::now(),
        // ]);
    }
}
