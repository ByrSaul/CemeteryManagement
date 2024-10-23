<?php

namespace CemeteryManagement\Entities\User;

use CemeteryManagement\Domain\Entities\AbstractEntity;
use CemeteryManagement\Traits\Entities\CommonEntity;
use CemeteryManagement\Traits\Entities\ActivableEntity;
use CemeteryManagement\Traits\Entities\AuditableEntity;
use CemeteryManagement\Traits\Entities\SoftDeletableEntity;

class User extends AbstractEntity
{
    /**
     * Implements Common field Entity
     */
    use CommonEntity;

    /**
     * Implements Ativable field entity
     */
    use ActivableEntity;

    /**
     * Implements Auditable field entity
     */
    use AuditableEntity;

    /**
     * Implements Soft Deleted field Entity
     */
    use SoftDeletableEntity;

    /**
     * @var string
     */
    private string $user_name;

    /**
     * @var string
     */
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
