<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deactivates FKs checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

         $this->call(JsonSeeder::class);

        // Reactivates FKs checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
