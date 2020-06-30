<?php

namespace App\Observers;

use App\Models\Admin;
use Illuminate\Support\Facades\Storage;

class AdminObserver
{
    /**
     * Handle the admin "created" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function created(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "updated" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function updated(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "deleted" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function deleted(Admin $admin)
    {
        // get avatar information
        $avatar = $admin->file;
        // delete avatar in storage
        Storage::disk('public')->delete("admin/".$avatar->upload_name);
        // delete avatar in DB
        $admin->file()->delete();
    }

    /**
     * Handle the admin "restored" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function restored(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "force deleted" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function forceDeleted(Admin $admin)
    {
        //
    }
}
