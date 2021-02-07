<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //generate logo
        $webLogo = factory(App\Models\File::class)->create(["additional" => "general"]);

        $config = [
            ['key' => 'name', 'value' => 'GProject'],
            ['key' => 'footer', 'value' => 'GProject - Resource Management'],
            ['key' => 'logo', 'value' => $webLogo->path],
        ];

        foreach ($config as $row) {
            Setting::create($row);
        }
    }
}
