<?php

use App\Models\Institution;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Mathrix\Lumen\Zero\Database\BaseTableSeeder;


class DatabaseSeeder extends BaseTableSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedFromFactory(User::class, 100);
        DB::update("UPDATE `users` SET `email` = CONCAT('user-', id, '@mathrix.fr') WHERE id > 0");
        DB::update("UPDATE `users` SET `scopes` = '[\"*\"]' WHERE id <= 10");

        $this->seedFromFactory(Institution::class, 20);
        $this->seedFromFactory(Plan::class, 50);
    }
}
