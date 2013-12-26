<?php

namespace hu\szjani\sample\domain\model\user;

use Assert\Assertion;
use precore\util\UUID;
use predaddy\domain\AggregateRoot;
use predaddy\messagehandling\annotation\Subscribe;

class User extends AggregateRoot
{
    private $userId;
    private $email;
    private $passwordHash;

    public function __construct($email, $rawPassword)
    {
        Assertion::email($email, "Invalid email address [$email]");
        $this->raise(new UserCreated(UUID::randomUUID()->toString(), $email, $rawPassword));
    }

    /**
     * @throws \InvalidArgumentException if a parameter is invalid
     */
    public function updateEmail($newEmail, $currentRawPassword)
    {
        // validate parameters and the state of the AR, throw exception if necessary
        Assertion::email($newEmail, "Invalid email address [$newEmail]");
        Assertion::eq($this->passwordHash, md5($currentRawPassword), "Invalid password");

        // send a DomainEvent
        $this->raise(new UserEmailUpdated($this->userId, $newEmail));
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @Subscribe
     * @param UserCreated $event
     */
    private function handleUserCreated(UserCreated $event)
    {
        $this->userId = $event->getAggregateIdentifier();
        $this->email = $event->getEmail();
        $this->passwordHash = md5($event->getRawPassword());
    }

    /**
     * @Subscribe
     * @param UserEmailUpdated $event
     */
    private function handleUserEmailUpdated(UserEmailUpdated $event)
    {
        $this->email = $event->getEmail();
    }
}
