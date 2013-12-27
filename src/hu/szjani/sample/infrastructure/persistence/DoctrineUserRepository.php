<?php

namespace hu\szjani\sample\infrastructure\persistence;

use hu\szjani\sample\domain\model\user\User;
use hu\szjani\sample\domain\model\user\UserRepository;

class DoctrineUserRepository implements UserRepository
{
    private $entityManager;

    /**
     * @param string $userId
     * @return User|null
     */
    public function findOneById($userId)
    {
        // TODO: Implement findOneById() method.
    }

    /**
     * @param User $user
     * @param int|null $version
     * @return void
     */
    public function store(User $user, $version = null)
    {
        // TODO: Implement store() method.
    }
}
 