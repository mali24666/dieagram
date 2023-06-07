<?php

namespace App\Observers;
use App\Events\esfeltFinsh;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class taskobserv
{
    /**
     * Handle the Esfelt "created" event.
     *
     * @param  \App\Models\Esfelt  $esfelt
     * @return void
     */

    /**
     * Handle the Esfelt "updated" event.
     *
     * @param  \App\Models\Esfelt  $esfelt
     * @return void
     */
    public function updated(task  $task )
    {               
            $current_timestamp = Carbon::now()->toDateTimeString();

            $id = $task->id;
            $etmam = $task->etmam;
            $kholow = $task->kholow;
            $stuts = $task->stuts;

            if ($etmam!==null) {
                $saveHistory3 = DB::table('tasks') 
                ->where('id', $id)
                ->update( ['enjaz_stuts' => '9' ,'updated_at' => $current_timestamp]
                );
                return $saveHistory3 ;
                }
                if ($kholow!==null) {
                    $saveHistory3 = DB::table('tasks') 
                    ->where('id', $id)
                    ->update( ['enjaz_stuts' => '10' ,'updated_at' => $current_timestamp]
                    );
                    return $saveHistory3 ;
                    }
                    
                    if ($stuts==2) {
                        $saveHistory4 = DB::table('tasks') 
                        ->where('id', $id)
                        ->update( ['enjaz_stuts' => '7' ,'close_done' => $current_timestamp ,'updated_at' => $current_timestamp]
                        );
                        return $saveHistory4 ;
                        }
    
    }

}
