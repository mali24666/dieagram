<?php

namespace App\Listeners;

use App\Events\stationTranse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Esfelt;
use App\Models\Task;

class stationTranseL
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
     * @param  \App\Events\showLicesNumber  $event
     * @return void
     */
    public function handle(stationTranse $event)
    {
        $Esfelt = $event->Esfelt ;
        // dd($Esfelt);
        $lics_no_id = $Esfelt->lics_no_id;

        $current_timestamp = Carbon::now()->toDateTimeString();
        // $id = $task->id;
        // $name  = $task->name ;
        $saveHistory2 = DB::table('tasks') 
        ->where('id', $lics_no_id)
        ->update( [ 'esfelt_done' => $current_timestamp,'responser' => 3 , 'station' => 4 ,'updated_at' => $current_timestamp]
        );

        //  dd($saveHistory);
        return $saveHistory2 ;

    }
}
