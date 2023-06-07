<?php

namespace App\Observers;
use App\Events\esfeltFinsh;
use App\Models\Esfelt;
use App\Events\reject;
use Illuminate\Support\Facades\DB;
use App\Events\cons;

class esefeltObserve
{
    /**
     * Handle the Esfelt "created" event.
     *
     * @param  \App\Models\Esfelt  $esfelt
     * @return void
     */
    public function created(Esfelt $esfelt)
    {
    
    
    }

    /**
     * Handle the Esfelt "updated" event.
     *
     * @param  \App\Models\Esfelt  $esfelt
     * @return void
     */
    public function updated(esfelt  $esfelt )
    {            
            $id = $esfelt->id;
    
            $saveHistory2 = DB::table('esfelts') 
            ->find($id);
            // dd($saveHistory2);
            $cons = $saveHistory2->cons;
            $esfelt_stuts= $saveHistory2->esfelt_stuts;
            // dd($cons);
            event(new cons($esfelt ));
            if ($esfelt_stuts ==2) {
                event(new esfeltFinsh($esfelt ));
                
            }
    }

    /**
     * Handle the Esfelt "deleted" event.
     *
     * @param  \App\Models\Esfelt  $esfelt
     * @return void
     */
    public function deleted(Esfelt $esfelt)
    {
    }

    /**
     * Handle the Esfelt "restored" event.
     *
     * @param  \App\Models\Esfelt  $esfelt
     * @return void
     */
    public function restored(Esfelt $esfelt)
    {
        //
    }

    /**
     * Handle the Esfelt "force deleted" event.
     *
     * @param  \App\Models\Esfelt  $esfelt
     * @return void
     */
    public function forceDeleted(Esfelt $esfelt)
    {
        //
    }
}
