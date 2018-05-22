<?php

namespace PhpArch;

class AuthAdapter
{
    // <snip>
    public function authenticate()
    {
        $user = $this->service->getUserByUsername($this->getUsername());

        if ($user instanceof GuestUser ||
            !password_verify($this->getPassword(), $user->getPassword())
        ) {
            return new GuestUser();
        }

        return $user;
    }
}
