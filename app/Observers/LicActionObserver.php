<?php

namespace App\Observers;

use App\Models\Lic;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class LicActionObserver
{
    public function created(Lic $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Lic'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
