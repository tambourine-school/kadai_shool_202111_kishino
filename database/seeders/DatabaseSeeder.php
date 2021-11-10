<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table("tasks")->insert([
            "plan" => "運動30分",
            "date_do" => Carbon::now(),
            "status" => 0,
            "check" => "できた理由",
            "action" => "次にどうするか",
            "created_at" => Carbon::now(),
        ]);
        DB::table("tasks")->insert([
            "plan" => "腕立て100回",
            "date_do" => Carbon::now(),
            "status" => 0,
            "check" => "できた理由",
            "action" => "次にどうするか",
            "created_at" => Carbon::now(),
        ]);
        DB::table("tasks")->insert([
            "plan" => "腹筋100回",
            "date_do" => Carbon::now(),
            "status" => 0,
            "check" => "できた理由",
            "action" => "次にどうするか",
            "created_at" => Carbon::now(),
        ]);
        DB::table("tasks")->insert([
            "plan" => "朝に運動をする",
            "date_do" => Carbon::now(),
            "status" => 1,
            "check" => "時間を決めたのがよかった",
            "action" => "質を重視したトレーニングにする",
            "created_at" => Carbon::now(),
        ]);
        DB::table("tasks")->insert([
            "plan" => "運動をする",
            "date_do" => Carbon::now(),
            "status" => 2,
            "check" => "飲み会に誘われた",
            "action" => "朝に運動をする",
            "created_at" => Carbon::now(),
        ]);
    }
}
