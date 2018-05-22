<?php
// <snip>
class AuthAdapterSpec
{
	// <snip>
    function it_will_return_a_guest_user_for_bad_password($service, AuthedUser $authedUser)
    {
        $service->getUserByUsername('bob')->willReturn($authedUser);
        
        $authedUser->getPassword()->willReturn('badpasswordhash');
        
        $this->setPassword('password');
        $this->setUsername('bob');
        
        $this->authenticate()->shouldHaveType(GuestUser::class);
    }
}