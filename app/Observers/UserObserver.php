<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        // get avatar information
        $avatar = $user->file;
        // delete avatar in storage
        Storage::disk('public')->delete("user/".$avatar->upload_name);
        // delete avatar in DB
        $user->file()->delete();
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
