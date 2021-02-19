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

    private function __construct(User $user)
    {
        $this->setUser($user);
        $this->roles = $user->roles()->get();
    }

    /**
     * Создает Сервис
     * Если user не передан и пользователь не авторизован, возвращает false
     *
     * @param User|null $user
     * @return false|RoleService
     */
    public static function initialize(User $user = null)
    {
        if (isset($user)) {

            return new RoleService($user);

        } elseif (isset($_SESSION['username'])) {
            $user = User::getUserByName($_SESSION['username']);

            return new RoleService($user);
        } else {
            return false;
        }
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }


    /* Permission's methods */
    public function getPermissions(): Collection
    {
        return $this->user->getRules();
    }

    /**
     * Установить права
     *
     * Можно передаввать комбинированный массив из id(int) и key(string)
     *
     * @param int | string $role_id
     * @param int | string | array $rule_key
     */
    public static function setPermission(int $role_id, $rule_key)
    {
        if (is_array($rule_key)) {
            /**
             * Если передан массив имён прав($rules), мы получаем коллекцию из getRuleByKey, а из неё массив id
             */
            foreach ($rule_key as $key) {
                Role::setRule(is_integer($role_id) ? $role_id : Role::getRoleByKey($rule_key)->id,
                    is_integer($key) ? $key : Rule::getRuleByKey($rule_key)->only('id')->all());
            }

        } else {

            Role::setRule(is_integer($role_id) ? $role_id : Role::getRoleByKey($rule_key)->id,
                is_integer($rule_key) ? $rule_key : Rule::getRuleByKey($rule_key)->id);
        }
    }

    /**
     * Есть ли права у пользователя, отдаёт true по первому совпадению
     *
     * Можно передаввать комбинированный массив из id(int) и key(string) (имён прав)
     *
     * @param string | int | array $rule_key
     * @return bool
     */
    public function hasPermission($rule_key): bool
    {
        if (is_array($rule_key)) {

            foreach ($rule_key as $perm) {
                if ($this->user->getRules()->contains((is_integer($perm)) ? 'id' : 'key',
                    '==', $perm)) {
                    return true;
                }
            }

            return false;

        } else {

            return $this->user->getRules()->contains((is_integer($rule_key)) ? 'id' : 'key',
                '==', $rule_key);
        }
    }

    /** Role's methods */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    /**
     * Установить пользователю роль
     *
     * Можно передаввать комбинированный массив из id(int) и key(string) (имён Ролей)
     *
     * @param int $user_id
     * @param int | string | array $role_key
     */
    public function setRole(int $user_id, $role_key)
    {
        if (is_array($role_key)) {
            foreach ($role_key as $key) {
                User::setRole($user_id, is_integer($key) ? $key : Role::getRoleByKey($key)->id);
            }
        } else {
            User::setRole($user_id, is_integer($role_key) ? $role_key : Role::getRoleByKey($role_key)->id);
        }
    }

    /**
     * Принадлежит ли пользователь к одной из ролей, отдаёт true по первому совпадению
     *
     * Можно передаввать комбинированный массив из id(int) и key(string) (имён Ролей)
     *
     * @param int | string | array $role_key
     * @return bool
     */
    public function hasRole($role_key): bool
    {
        if (is_array($role_key)) {
            foreach ($role_key as $key) {
                if($this->roles->contains(is_integer($key) ? 'id' : 'key', '==', $key)){
                    return true;
                }
            }

            return false;
        } else {

            return $this->roles->contains(is_integer($role_key) ? 'id' : 'key', '==', $role_key);
        }
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