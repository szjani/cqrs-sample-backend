<?php

namespace hu\szjani\sample\domain\model\user;

use PHPUnit_Framework_TestCase;
use predaddy\domain\AggregateRoot;
use predaddy\messagehandling\annotation\AnnotatedMessageHandlerDescriptorFactory;
use predaddy\messagehandling\DefaultFunctionDescriptorFactory;
use predaddy\messagehandling\SimpleMessageBus;

class UserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SimpleMessageBus
     */
    private $bus;

    public function setUp()
    {
        parent::setUp();
        $funcDescFactory = new DefaultFunctionDescriptorFactory();
        $handlerDescFactory = new AnnotatedMessageHandlerDescriptorFactory($funcDescFactory);
        $this->bus = new SimpleMessageBus(__CLASS__, $handlerDescFactory, $funcDescFactory);
        AggregateRoot::setEventBus($this->bus);
    }

    public function testEmailUpdate()
    {
        $email = 'test@example.com';
        $newEmail = 'test2@example.com';
        $pass = 'randomPass';
        $user = new User($email, $pass);
        $called = false;
        $this->bus->registerClosure(
            function (UserEmailUpdated $event) use (&$called, $user) {
                UserTest::assertEquals($user->getUserId(), $event->getAggregateIdentifier());
                UserTest::assertEquals($user->getEmail(), $event->getEmail());
                $called = true;
            }
        );
        $user->updateEmail($newEmail, $pass);
        self::assertTrue($called);
    }
}
