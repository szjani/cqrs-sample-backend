<?php

namespace hu\szjani\sample\application\user;

use Assert\Assertion;
use hu\szjani\sample\command\user\CreateUser;
use hu\szjani\sample\command\user\ModifyEmail;
use hu\szjani\sample\domain\model\user\User;
use hu\szjani\sample\domain\model\user\UserRepository;
use precore\lang\Object;
use predaddy\messagehandling\annotation\Subscribe;

class UserCommandHandler extends Object
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Subscribe
     * @param CreateUser $command
     */
    public function handleCreateUser(CreateUser $command)
    {
        $user = new User($command->getEmail(), $command->getRawPassword());
        $this->userRepository->store($user);
        self::getLogger()->info("User [{}] has been created", array($command->getEmail()));
    }

    /**
     * @Subscribe
     * @param ModifyEmail $command
     */
    public function handleModifyEmail(ModifyEmail $command)
    {
        $userId = $command->getUserId();
        $newEmail = $command->getEmail();
        $user = $this->userRepository->findOneById($userId);
        Assertion::notNull($user, "Invalid user ID [{$userId}]");
        $user->updateEmail($newEmail, $command->getRawPassword());
        $this->userRepository->store($user, $command->getVersion());
        self::getLogger("User's [{}] email has been modified to [{}]", array($userId, $newEmail));
    }
}
