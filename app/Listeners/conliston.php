<?php

namespace App\Listeners;

use App\Events\cons;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Esfelt;
use App\Models\Task;
class conliston
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
     * @param  \App\Events\cons  $event
     * @return void
     */
    public function handle(cons $event)
    {
        $esfelt = $event->esfelt ;
        // dd($esfelt);
        $id = $esfelt->id;

        // dd($lics_no_id);
        $saveHistory2 = DB::table('esfelts') 
        ->find($id);
        // dd($saveHistory2);
        $lics_no_id = $saveHistory2->lics_no_id;
        $cons = $saveHistory2->cons;
        $delivery = $saveHistory2->delivery;
        $current_timestamp = Carbon::now()->toDateTimeString();
        $saveHistory3 = DB::table('tasks') 
        ->where('id', $lics_no_id)
        ->update( ['con' => $cons , 'enjaz_stuts' => $delivery ,'updated_at' => $current_timestamp]
        );
        
        if ($delivery == 4 || $delivery == 6 ) {
            $saveHistory4 = DB::table('tasks') 
            ->where('id', $lics_no_id)
            ->update( ['enjaz' => $current_timestamp ]
            );
            }
        //  dd($saveHistory3);
        return $saveHistory3 ;
        return $saveHistory4 ;

    }
}
