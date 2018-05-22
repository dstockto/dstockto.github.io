<?php

namespace PhpArch;

class AuthAdapter
{
    // snip
    public function authenticate()
    {
        $user = $this->service->getUserByUsername($this->getUsername());

        if ($user instanceof GuestUser) {
            return new GuestUser();
        }

        if (!password_verify($this->getPassword(), $user->getPassword())) {
            return new GuestUser();
        }

        return $user;
    }
}
