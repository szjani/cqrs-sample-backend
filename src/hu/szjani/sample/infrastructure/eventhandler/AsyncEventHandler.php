<?php

namespace hu\szjani\sample\infrastructure\eventhandler;

use hu\szjani\sample\domain\shared\AsyncEvent;
use predaddy\messagehandling\MessageBus;

class AsyncEventHandler
{
    private $asyncBus;

    public function __construct(MessageBus $asyncBus)
    {
        $this->asyncBus = $asyncBus;
    }

    public function handleAsyncEvent(AsyncEvent $event)
    {
        $this->asyncBus->post($event);
    }
}
