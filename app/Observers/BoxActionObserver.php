<?php

namespace App\Observers;

use App\Models\Box;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class BoxActionObserver
{
    public function created(Box $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Box'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Box $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Box'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Box $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Box'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
