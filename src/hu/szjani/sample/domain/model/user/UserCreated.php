<?php

namespace hu\szjani\sample\domain\model\user;

use predaddy\domain\DomainEvent;

class UserCreated extends DomainEvent
{
    private $email;
    private $rawPassword;

    public function __construct($userId, $email, $rawPassword)
    {
        parent::__construct($userId);
        $this->email = $email;
        $this->rawPassword = $rawPassword;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getRawPassword()
    {
        return $this->rawPassword;
    }
}
