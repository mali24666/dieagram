<?php

namespace App\Observers;

use App\Models\Esfelt;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class EsfeltActionObserver
{
    public function created(Esfelt $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Esfelt'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Esfelt $model)
    {
        // $data  = ['action' => 'updated', 'model_name' => 'Esfelt'];
        // $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        // Notification::send($users, new DataChangeEmailNotification($data));

        $esfelt = $model->esfelt ;
        dd($esfelt);
        $lics_no_id = $esfelt->lics_no_id;
        $delivery = $esfelt->delivery;
        // dd($lics_no_id);

        $current_timestamp = Carbon::now()->toDateTimeString();
        $saveHistory2 = DB::table('tasks') 
        ->where('id', $lics_no_id)
        ->update( ['responser' => '4' , 'station' => $delivery ,'updated_at' => $current_timestamp]
        );

        //  dd($saveHistory2);
        return $saveHistory2 ;
    
    }
}
