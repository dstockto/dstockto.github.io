<?php
namespace spec\PhpArch;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthAdapterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PhpArch\AuthAdapter');
    }

    function it_will_accept_a_username()
    {
        $this->setUsername('bob');
        $this->getUsername()->shouldBe('bob');

        $this->setUsername('frank');
        $this->getUsername()->shouldBe('frank');
    }

    function it_will_accept_a_password()
    {
        $password = uniqid();
        $this->setPassword($password);
        $this->getPassword()->shouldBe($password);
    }
}
