<?php


namespace workspace\models;


use core\Debug;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use workspace\modules\users\requests\UsersSearchRequest;

class User extends Model
{
    protected $table = "user";

    public $fillable = ['username', 'email', 'password_hash'];

    public static function getCurrentUserName()
    {
        return $_SESSION['username'] ?? null;
    }

    public static function storeUser($username, $email, $password, $roles = null)
    {
        $model = new User();
        $model->username = $username;
        $model->email = $email;
        $model->password_hash = password_hash($password, PASSWORD_DEFAULT);
        $model->save();

        if (isset($roles)) {
            $model->roles()->attach($roles); //TODO CL was sync
        }
    }

    public static function updateUser($id, $username, $email, $roles)
    {
        $model = User::findOrFail($id);

        $model->roles()->detach();

        $model->username = $username;
        $model->email = $email;
        $model->save();

        if (isset($roles)) {
            $model->roles()->sync($roles);
        }
    }

    public static function deleteUser($id)
    {
        $user = User::findOrFail($_POST['id']);
        $user->roles()->detach();
        $user->delete();
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role_relations',
            'user_id', 'role_id',
            'id', 'id');
    }

    public function getRules(): Collection
    {                                           //TODO сделать более "прямым" способом
        $roles = $this->roles()->getModels();

        $rules = new Collection();
        foreach ($roles as $role) {
            $rules = $rules->merge($role->rules);
        }

        return $rules;
    }

    public static function setRole(int $id, string $role_id)
    {
        $user = User::findOrFail($id);
        $user->roles()->syncWithoutDetaching($role_id);
    }

    public static function search(UsersSearchRequest $request)
    {
        $query = self::query();

        if ($request->username)
            $query->where('username', 'LIKE', "%$request->username%");

        if ($request->email)
            $query->where('email', 'LIKE', "%$request->email%");

        return $query->get();
    }

    /**
     * @param string $username
     * @return User | false
     */
    public static function getUserByName(string $username)
    {
        $user = User::where('username', $username);

        if($user->exists()){
            return $user->first();
        } else {
            throw new ModelNotFoundException('User not found!');
        }
    }
}