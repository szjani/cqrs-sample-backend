<?php

namespace hu\szjani\sample\domain\model\user;

use predaddy\domain\DomainEvent;

class UserEmailUpdated extends DomainEvent
{
    private $email;

    public function __construct($userId, $email)
    {
        parent::__construct($userId);
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
