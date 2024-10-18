<?php

namespace CemeteryManagement\ValueObjects\Data;

use CemeteryManagement\Entities\User\User;
use CemeteryManagement\Entities\System\Auth\AuthMenu;
use CemeteryManagement\Entities\System\ERPMenu;
use CemeteryManagement\Exceptions\System\Auth\AuthPermission\AuthPermissionNotFoundException;
use CemeteryManagement\Factories\Repositories\System\Auth\AuthMenuFactory;
use CemeteryManagement\Factories\Repositories\System\ERPMenuFactory;

class Permissions
{
    /**
     * User logged
     * @var object
     */
    protected object $user;

    /**
     * permissions allowed to user
     * @var array
     */
    protected array $permissions;

    /**
     * Fingerprint from device
     * @var string
     */
    protected string $fingerprint;

    /**
     * @var ERPMenu
     */
    protected ERPMenu $ERPMenuEntity;

    /**
     * @var AuthMenu
     */
    protected AuthMenu $authMenuEntity;

    public function __construct(object $permissions)
    {
        if (!property_exists($permissions, 'data') || !property_exists($permissions, 'permissions')) {
            throw new AuthPermissionNotFoundException();
        }

        if (empty($permissions->data) || empty($permissions->permissions)) {
            throw new AuthPermissionNotFoundException();
        }

        $newCollection = array();
        $this->user = $permissions->data;

        foreach ($permissions->permissions as $permission) {
            $newCollection[] = $permission;
        }

        $this->permissions = $newCollection;

        if (property_exists($permissions, 'fingerprint')) {
            if ($permissions->fingerprint === '' || $permissions->fingerprint === null) {
                $this->fingerprint = 'Undefined';
            } else {
                $this->fingerprint = $permissions->fingerprint;
            }
        } else {
            $this->fingerprint = 'Undefined';
        }
    }

    /**
     * check if user has required permissions
     *
     * @var     $service    string      scope required
     * @var     $action     action      action required for scope
     *
     * @throws AuthPermissionNotFoundException
     */
    public function checkUserPermission(array $requiredPermissions): bool
    {
        $result = $this->getPermissionByScopeAndAction($requiredPermissions);
        if ($result !== true) {
            $message = implode(": ", $result);
            throw new AuthPermissionNotFoundException('Usuario no cuenta con el permiso ' . $message, 403);
        }

        return true;
    }

    /**
     * Return user and permission records
     */
    public function getUserPermissions()
    {
        return ['user' => $this->user, 'permissions' => $this->permissions];
    }

    /**
     * Return user information
     */
    public function getUser(): User
    {
        return new User((array) $this->user);
    }

    /**
     * Return Permissions
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Return fingerprint
     */
    public function getFingerprint()
    {
        return $this->fingerprint;
    }

    /**
     * Return specific permission by scope and action
     * @return bool|array
     */
    public function getPermissionByScopeAndAction(array $requiredPermissions): bool | array
    {
        foreach ($requiredPermissions as $requiredkey => $requiredValues) {
            // Check if scope existe into user permissions allowed
            $keys = array_keys(array_column($this->permissions, 'scope'), $requiredkey);

            if ($keys !== false) {
                foreach ($requiredValues as $requiredValue) {
                    foreach ($keys as $key) {
                        // Check if action allowed to user is match with required permission
                        if ($this->permissions[$key]->action == $requiredValue) {
                            continue 2;
                        }
                    }

                    if (
                        !$this->checkParentPermissions($this->getUser()->getUsrNumber(), $requiredValue, $requiredkey)
                    ) {
                        return [$requiredkey, $requiredValue];
                    }
                }
            }
        }

        return true;
    }

    /**
     * Check if user have a required permission into menu father
     *
     * @param   int     $usrNumber      User Identifier
     * @param   string  $action         Action required by service
     * @param   string  $scope          Permission required by service
     * @param   int     $menuId         Menu identifier
     *
     * @return bool
     */
    public function checkParentPermissions(int $usrNumber, string $action, string $scope, int $menuId = -1): bool
    {
        $ERPMenuRepository = ERPMenuFactory::get();
        $authMenuRepository = AuthMenuFactory::get();

        // Retrieve parent menu id
        if ($menuId === -1) {
            $baseAuthMenu = $authMenuRepository->getByScopeAndAction($scope, $action);
            if ($baseAuthMenu === null) {
                return false;
            }

            $baseMenuId = $baseAuthMenu->getMenuId();
        } else {
            $baseMenuId = $menuId;
        }

        $parentBaseMenu = $ERPMenuRepository->getById($baseMenuId);
        if (
            $parentBaseMenu->getLevel() === 0 || $parentBaseMenu->getLft() === 0 || $parentBaseMenu->getParentId() === 0
        ) {
            return false;
        }

        $parentBaseMenuId = $parentBaseMenu->getParentId();

        // Check if the user has the required permissions
        $record = $authMenuRepository->getByUsrNumberAndMenuIdAndAction($usrNumber, $parentBaseMenuId, $action);

        if ($record == null) {
            // Check parent node if last menu do not have required permissions
            $this->ERPMenuEntity = $ERPMenuRepository->getById($parentBaseMenuId);

            if ($this->ERPMenuEntity->getLevel() == 0 && $this->ERPMenuEntity->getLft() == 0) {
                return false;
            }

            return $this->checkParentPermissions($usrNumber, $action, '', $this->ERPMenuEntity->getId());
        }

        // Check if toke has contents the required permissions
        $keys = array_keys(array_column($this->permissions, 'scope'), $record->getScope());
        if ($keys !== false) {
            foreach ($keys as $key) {
                // Check if action allowed to user is match with required permission
                if ($this->permissions[$key]->action == $action) {
                    return true;
                }
            }
        }

        return false;
    }
}
