<?php

namespace App\Listeners;

use App\Events\reject;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Esfelt;
use App\Models\Task;

class rejectListon
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
     * @param  \App\Events\reject  $event
     * @return void
     */
    public function handle(reject $event)
    {
        $esfelt = $event->esfelt ;
        // dd($esfelt);
        $delivery = $esfelt->delivery;
        $id = $esfelt->id;

        // dd($lics_no_id);
        $saveHistory2 = DB::table('esfelts') 
        ->find($id);
        // dd($saveHistory2);
        $lics_no_id = $saveHistory2->lics_no_id;
        // dd($lics_no_id);

        $current_timestamp = Carbon::now()->toDateTimeString();
        $saveHistory3 = DB::table('tasks') 
        ->where('id', $lics_no_id)
        ->update( ['responser' => '4' , 'station' => $delivery ,'updated_at' => $current_timestamp]
        );

        //  dd($saveHistory3);
        return $saveHistory3 ;
    }
}
