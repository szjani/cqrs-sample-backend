<?php

namespace hu\szjani\sample\domain\model\user;

interface UserRepository
{
    /**
     * @param string $userId
     * @return User|null
     */
    public function findOneById($userId);

    /**
     * @param User $user
     * @param int|null $version
     * @return void
     */
    public function store(User $user, $version = null);
}
