<?php

namespace App\Listeners;

use App\Events\addToEsfeltEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Esfelt;
use App\Models\Task;
use App\Events\cons;

class esfeltTimeTranse
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\addToEsfeltEvent  $event
     * @return void
     */
    public function handle(addToEsfeltEvent $event)
    {       
         $esfelt  = $event->esfelt ;
       
        $current_timestamp = Carbon::now()->toDateTimeString();
        $lics_no_id = $esfelt->lics_no_id;
        // $lics_nos = Task::find($request->id);
        // $lics_no_id = Esfelt::find($request->lics_no_id);
        // 
        // $saveHistory = DB::table('tasks')
        // ->where('name', $lics_nos)
        // ->update(['start_time->saveHistory']);
        $saveHistory = DB::table('tasks') 
        ->where('id', $lics_no_id)
        ->update( ['move_to_con_date' => $current_timestamp, 'responser' => 4 , 'updated_at' => $current_timestamp]
        );
        // dd($lics_no_id);
        return $saveHistory;
    }
}
