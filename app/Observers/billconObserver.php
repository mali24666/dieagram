<?php

namespace App\Observers;

use App\Models\Billcon;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class billconObserver
{
    /**
     * Handle the Billcon "created" event.
     *
     * @param  \App\Models\Billcon  $billcon
     * @return void
     */
    public function created(Billcon $billcon)
    {
        $price_1=$billcon->price_1;
        $price_2=$billcon->price_2;
        $price_3=$billcon->price_3;

        $count_1=$billcon->count_1;
        $count_2=$billcon->count_2;
        $count_3=$billcon->count_3;

        $descount_1=$billcon->descount_1;
        $descount_2=$billcon->descount_2;
        $descount_3=$billcon->descount_3;
        $descount_4=$billcon->descount_4;
        $descount_5=$billcon->descount_5;
        $descount_6=$billcon->descount_6;
        $descount_7=$billcon->descount_7;
        $descount_8=$billcon->descount_8;
        // $descount_9=$billcon->descount_9;
        $descount_10=$billcon->descount_10;
        // $descount_11=$billcon->descount_11;


        $totall=$price_1* $count_1;
        $totall_2=$price_2* $count_2;
        $totall_3=$price_3* $count_3;

        $totall_4 =$totall+ $totall_2+ $totall_3;
        $descount_9 =
        $descount_1+$descount_2
                        +$descount_3+$descount_4+
                        $descount_5+$descount_6+
                        $descount_7+$descount_8;
        $descount_11 =$totall_4-
                       ($descount_9+$descount_10) ;
        $id = $billcon->id;
    
        $saveHistory3 = DB::table('billcons') 
        ->where('id', $id)
        ->update( ['totall' => $totall , 'totall_2' => $totall_2 ,'totall_3' => $totall_3,'totall_4' => $totall_4
        , 'descount_9' => $descount_9, 'descount_11' => $descount_11 ]
        );
        return $saveHistory3 ;

    
   }

    /**
     * Handle the Billcon "updated" event.
     *
     * @param  \App\Models\Billcon  $billcon
     * @return void
     */
    public function updating(Billcon $billcon)
    {      
        //   dd($billcon);

        $price_1=$billcon->price_1;
        $price_2=$billcon->price_2;
        $price_3=$billcon->price_3;

        $count_1=$billcon->count_1;
        $count_2=$billcon->count_2;
        $count_3=$billcon->count_3;

        $totall=$billcon->totall;
        $totall_2=$billcon->totall_2;
        $totall_3=$billcon->totall_3;
        $totall_4=$billcon->totall_4;


        $descount_1=$billcon->descount_1;
        $descount_2=$billcon->descount_2;
        $descount_3=$billcon->descount_3;
        $descount_4=$billcon->descount_4;
        $descount_5=$billcon->descount_5;
        $descount_6=$billcon->descount_6;
        $descount_7=$billcon->descount_7;
        $descount_8=$billcon->descount_8;
        $descount_9=$billcon->descount_9;
        $descount_10=$billcon->descount_10;
        $descount_11=$billcon->descount_11;


        $descount_9 =
        $descount_1+$descount_2
                        +$descount_3+$descount_4+
                        $descount_5+$descount_6+
                        $descount_7+$descount_8;

        $totall=$price_1* $count_1;
        $totall_2=$price_2* $count_2;
        $totall_3=$price_3* $count_3;

        $totall_4 =$totall+ $totall_2+ $totall_3;
        $descount_11 =$totall_4-
                       ($descount_9+$descount_10) ;

        $id = $billcon->id;

        $saveHistory3 = DB::table('billcons') 
        ->update( ['totall' => $totall , 'totall_2' => $totall_2 ,'totall_3' => $totall_3,'totall_4' => $totall_4
        , 'descount_9' => $descount_9, 'descount_11' => $descount_11 ]
        );

        return $saveHistory3 ;
    }

    /**
     * Handle the Billcon "deleted" event.
     *
     * @param  \App\Models\Billcon  $billcon
     * @return void
     */
    public function deleted(Billcon $billcon)
    {
        //
    }

    /**
     * Handle the Billcon "restored" event.
     *
     * @param  \App\Models\Billcon  $billcon
     * @return void
     */
    public function restored(Billcon $billcon)
    {
        //
    }

    /**
     * Handle the Billcon "force deleted" event.
     *
     * @param  \App\Models\Billcon  $billcon
     * @return void
     */
    public function forceDeleted(Billcon $billcon)
    {
        //
    }
}
