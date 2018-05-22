<?php
    public function authenticate()
    {
        $user = $this->service->getUserByUsername($this->username);
        return $user;
    }
