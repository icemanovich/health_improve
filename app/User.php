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

/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $type
 * @property string $description
 * @property string $workplace
 * @property string $speciality
 * @property string $photo
 * @property string $gender
 * @property string $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read mixed $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bican\Roles\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bican\Roles\Models\Permission[] $userPermissions
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereWorkplace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSpeciality($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhoto($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User doctor()
 * @mixin \Eloquent
 * @property string $phone
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhone($value)
 */
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
    protected $dates  = ['created_at', 'updated_at', 'deleted_at'];

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

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDoctor($query)
    {
        return $query->where('type', self::TYPE_DOCTOR);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function scopeWorkplace()
    {
        return $this->hasOne('App\Workplace', 'id', 'workplace_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function scopeSpeciality()
    {
        return $this->hasOne('App\Speciality', 'id', 'speciality_id');
    }

}
