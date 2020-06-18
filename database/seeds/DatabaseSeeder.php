<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DeviceSeeder::class);
        $this->call(UserDeviceSeeder::class);
    }
}
