<?php

namespace App;

use Bican\Roles\Models\Role;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
//                                    AuthorizableContract,
                                    CanResetPasswordContract
    , HasRoleAndPermissionContract
{
    use Authenticatable,
//        Authorizable,
        CanResetPassword,
        SoftDeletes,
        HasRoleAndPermission;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'description', 'workplace', 'speciality', 'gender'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];



    const TYPE_USER     = 'user';
    const TYPE_DOCTOR   = 'doctor';

    /**
     * @return mixed
     */
    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    /**
     * @param string $role_slug
     * @return bool
     */
    public function changeRole($role_slug){
        /** @var \Bican\Roles\Models\Role $role_model */
        $role_model = Role::query()->where('slug', $role_slug)->first();
        if (!$role_model) {
            return false;
        }

        $this->detachAllRoles();
        $result = $this->attachRole($role_model);

        return $result;
    }

}
