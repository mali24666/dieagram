<?php

namespace App\Observers;

use App\Models\Close;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class CloseActionObserver
{
    public function created(Close $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Close'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Close $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Close'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
