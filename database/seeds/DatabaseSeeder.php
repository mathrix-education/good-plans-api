<?php

use App\Models\Institution;
use App\Models\Plan;
use App\Models\User;
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
        $this->seedFromFactory(Institution::class, 20);
        $this->seedFromFactory(Plan::class, 50);
    }
}
