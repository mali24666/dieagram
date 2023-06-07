<?php

namespace App\Listeners;

use App\Events\esfeltFinsh;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Esfelt;
use App\Models\Task;

class finshEsfelt
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
    public function handle(esfeltFinsh $event)
    {
        $esfelt = $event->Esfelt ;
        // dd($esfelt);
        $id = $esfelt->id;

        // dd($lics_no_id);
        $saveHistory2 = DB::table('esfelts') 
        ->find($id);
        // dd($saveHistory2);
        $lics_no_id = $saveHistory2->lics_no_id;
        $end_esfelt_date = $saveHistory2->end_esfelt_date;
        $cons = $saveHistory2->cons;

        $current_timestamp = Carbon::now()->toDateTimeString();
if ($end_esfelt_date ==null) {
    $saveHistory = DB::table('esfelts') 
    ->where('id', $id)
    ->update( [ 'end_esfelt_date' => $current_timestamp ,'updated_at' => $current_timestamp]
    );

        $saveHistory3 = DB::table('tasks') 
        ->where('id', $lics_no_id)
        ->update( [ 'esfelt_done' => $current_timestamp,'updated_at' => $current_timestamp]
        );

        //  dd($saveHistory);
        return $saveHistory ;
        return $saveHistory3 ;
    }
    }
}
