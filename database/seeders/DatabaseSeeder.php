<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Project::factory(5)->create();
        Task::factory(25)->create();
        Comment::factory(50)->create();

        DB::table('roles')->insert([
            ['role' => 'manager'],
            ['role' => 'executor']
        ]);

        $pivotTableData = [];

        for ($i = 0; $i < 20; $i++) {
            $pivotTableData[] = [
                'user_id' => rand(1, 10),
                'project_id' => rand(1, 5),
                'role_id' => rand(1, 2)
            ];
        }

        DB::table('assigned_users_roles')->insert($pivotTableData);
    }
}
