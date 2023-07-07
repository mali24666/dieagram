<?php

namespace App\Providers;
use App\Models\Esfelt;
use App\Models\Task;
use App\Models\Billcon;
use App\Models\Project;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LoginHistory;
use App\Listeners\storeUserLoginHistory;
use App\Events\addToEsfeltEvent;
use App\Listeners\esfeltTimeTranse;
use App\Events\showLicesNumber;
use App\Listeners\showLicesListen;
use App\Events\esfeltFinsh;
use App\Listeners\finshEsfelt;
use App\Listeners\stationTranseL;
use App\Events\stationTranse;
use App\Listeners\rejectListon;
use App\Events\reject;
use App\Observers\esefeltObserve;
use App\Observers\taskobserv;
use App\Observers\billconObserver;
use App\Observers\ProjectObserver;



use App\Events\cons;
use App\Listeners\conliston;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoginHistory::class => [
            StoreUserLoginHistory::class,
        ],
        addToEsfeltEvent::class => [
            esfeltTimeTranse::class,
        ],
        showLicesNumber::class => [
            showLicesListen::class,
        ],
        esfeltFinsh::class => [
            finshEsfelt::class, 
        ],
        stationTranse::class => [
            stationTranseL::class, 
        ],
        reject::class => [
            rejectListon::class, 
        ],
        cons::class => [
            conliston::class, 
        ],

];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Esfelt::Observe(esefeltObserve::class);
        Task::Observe(taskobserv::class);
        Billcon::Observe(billconObserver::class);
        Project::Observe(ProjectObserver::class);

    }
}
