<?php

use Illuminate\Database\Seeder;

class UserDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\UserDevice::class, 5)->create();
    }
}
