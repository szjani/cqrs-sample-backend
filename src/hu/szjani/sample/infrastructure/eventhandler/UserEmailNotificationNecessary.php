<?php

namespace hu\szjani\sample\infrastructure\eventhandler;

use hu\szjani\sample\domain\model\user\UserEmailUpdated;
use predaddy\messagehandling\annotation\Subscribe;

class UserEmailNotificationNecessary
{
    /**
     * @Subscribe
     * @param UserEmailUpdated $event
     */
    public function sendNewEmail(UserEmailUpdated $event)
    {
        // post new command, or send email, etc.
    }
}
