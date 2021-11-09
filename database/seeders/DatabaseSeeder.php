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
            "plan" => "牛乳を買う",
            "date_do" => Carbon::now(),
            "status" => '実行中',
            "check" => "牛乳を買いに行く",
            "action" => "牛乳を買いに行く",
            "created_at" => Carbon::now(),
        ]);
        DB::table("tasks")->insert([
            "plan" => "旅行の予定を立てる",
            "date_do" => Carbon::now(),
            "status" => '達成',
            "check" => "友達との旅行の相談を Zoom で",
            "action" => "友達との旅行の相談を Zoom で",
            "created_at" => Carbon::now(),
        ]);
        DB::table("tasks")->insert([
            "plan" => "試験の勉強を進める",
            "date_do" => Carbon::now(),
            "status" => '未達成',
            "check" => "対策本を早めにやりきる",
            "action" => "対策本を早めにやりきる",
            "created_at" => Carbon::now(),
        ]);
    }
}
