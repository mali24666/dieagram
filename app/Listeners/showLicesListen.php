<?php

namespace App\Listeners;

use App\Events\showLicesNumber;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\lic;
use App\Models\Task;

class showLicesListen
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
    public function handle(showLicesNumber $event)
    {
        $task = $event->task ;
        // dd($task);

        // $current_timestamp = Carbon::now()->toDateTimeString();
        // $id = $task->id;
        $lics_no_id  = $task->lics_no_id ;
        $name  = $task->name ;
        $saveHistory = DB::table('lics') 
        ->where('id', $lics_no_id)
        ->update( [ 'task_number' => $name ,'order_stauts' => 5]
        );
        // dd($saveHistory);
        return $saveHistory;
    }
}
