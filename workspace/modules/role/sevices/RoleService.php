<?php


namespace workspace\modules\role\sevices;


use core\Debug;
use Illuminate\Database\Eloquent\Collection;
use workspace\models\Role;
use workspace\models\Rule;
use workspace\models\User;
use workspace\modules\role\requests\RoleDeleteRequest;
use workspace\modules\role\requests\RoleRequest;

class RoleService
{
    /**
     * @var Collection
     */
    public $roles;

    /**
     * @var User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->roles = $user->roles()->get();
    }

    /** Permission's methods */
    public function getPermissions(): Collection
    {
        return $this->user->getRules();
    }

    public static function setPermission(int $role_id, string $rule_key)
    {
        Role::setRule($role_id, $rule_key);
    }

    public function hasPermission(string $rule_key): bool
    {
        return $this->user->getRules()->contains('key', '==', $rule_key);
    }

    /** Role's methods */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function setRole(int $user_id, string $role_key){
        User::setRole($user_id, $role_key);
    }

    public function hasRole(string $role_key): bool
    {
        return $this->roles->contains('key', '==', $role_key);
    }

    public static function storeRole(RoleRequest $request)
    {
        Role::storeRole($request->key, $request->rules);
    }

    public static function editRole(RoleRequest $request)
    {
        Role::updateRole($request->id, $request->key, $request->rules, $request->users);
    }

    public static function deleteRole(RoleDeleteRequest $request)
    {
        Role::deleteRole($request->id);
    }

}