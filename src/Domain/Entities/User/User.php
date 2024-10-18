<?php

namespace CemeteryManagement\Domain\Entities\User;

use CemeteryManagement\Domain\Entities\AbstractEntity;

class User extends AbstractEntity
{
    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function checkPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
