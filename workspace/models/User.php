<?php


namespace workspace\models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = "user";

    public $fillable = ['username', 'email', 'role', 'password_hash'];

    public static function getCurrentUserName()
    {
        return $_SESSION['username'] ?? null;
    }

    public function _save($request)
    {
        $this->username = $request->username;
        $this->email = $request->email;
        $this->role = 2;
        $this->password_hash = password_hash($request->password, PASSWORD_DEFAULT);
        $this->save();
    }
}