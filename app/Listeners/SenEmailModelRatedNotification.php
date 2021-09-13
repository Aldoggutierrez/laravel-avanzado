<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\ModelRatedNotification;

class SenEmailModelRatedNotification
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
      $rateable = $event->getRateable();
      if($rateable instanceof Product)
      {
	$notification = new ModelRatedNotification($event->getQualifier()->name,$rateable->name,$event->getScore());

	$rateable->createdBy->notify($notification);
      }
    }
}
