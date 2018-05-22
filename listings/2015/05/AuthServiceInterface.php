<?php
namespace PhpArch;

interface AuthServiceInterface 
{
    /**
     * Returns a user object from the provided username. Provides AuthUser if username was found or
     * a GuestUser if not found. It's the caller's responsibility to check credentials if needed.
     * 
     * @return UserInterface
     */
    public function getUserByUsername($username);
}
