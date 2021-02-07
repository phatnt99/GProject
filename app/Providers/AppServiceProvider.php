<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Device;
use App\Models\Setting;
use App\Models\User;
use App\Observers\AdminObserver;
use App\Observers\CompanyObserver;
use App\Observers\DeviceObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        User::observe(UserObserver::class);
        Admin::observe(AdminObserver::class);
        Company::observe(CompanyObserver::class);
        Device::observe(DeviceObserver::class);

        //share view
        $listSetting = Setting::all();
        $structuredListSetting = $listSetting->reduce(function ($carry, $item) {
            $carry[$item['key']] = $item['value'];

            return $carry;
        });
        view()->share('general', [
            "logo"   => $structuredListSetting['logo'] ?? null,
            "footer" => $structuredListSetting['footer'] ?? null,
            "name"  => $structuredListSetting['name'] ?? null,
        ]);
    }
}
