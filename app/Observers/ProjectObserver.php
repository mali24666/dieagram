<?php

namespace App\Observers;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {
        $current_timestamp = Carbon::now()->toDateTimeString();
        $id = $project ->id;
        $ct_id = $project ->ct_id;
        $second_feeder = $project ->second_feeder;
        if ($ct_id==!null) {
            $second_feeder_int = intval($second_feeder) ;
            $second_feeder_new = ++$second_feeder_int;
            // dd($second_feeder_new);

            $saveHistory3 = DB::table('projects') 
            ->where('id', $id)
            ->update( ['second_feeder' => $second_feeder_new ,'updated_at' => $current_timestamp]
            );
            return $saveHistory3 ;
            }

        // dd($project);
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        dd(2);
    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {

    }

    /**
     * Handle the Project "restored" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
      
    }

    /**
     * Handle the Project "force deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
