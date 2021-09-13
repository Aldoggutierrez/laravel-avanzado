<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelRated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private Model $qualifier;
    private Model $rateable;
    private float $score;
    
    public function __construct(Model $qualifier,Model $rateable,float $score)
    {
      this->qualifier = $qualifier;
      this->rateable = $rateable;
      this->score = $score;
    }
    public function getQualifier()
    {
      return $this->$qualifier;
    }
    
    public function getScore()
    {
      return $this->$score;
    }
    
    public function getScore()
    {
      return $this->$scor;
    }
}
