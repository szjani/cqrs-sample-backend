<?php

namespace hu\szjani\sample\infrastructure\eventhandler;

use hu\szjani\sample\domain\shared\AsyncEvent;
use predaddy\messagehandling\MessageBus;
use predaddy\messagehandling\annotation\Subscribe;

class AsyncEventHandler
{
    private $asyncBus;

    public function __construct(MessageBus $asyncBus)
    {
        $this->asyncBus = $asyncBus;
    }

    /**
     * @Subscribe
     * @param AsyncEvent $event
     */
    public function handleAsyncEvent(AsyncEvent $event)
    {
        $this->asyncBus->post($event);
    }
}
