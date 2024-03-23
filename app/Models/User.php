<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    const MALE = 0;
    const FEMALE = 1;

    const ACTIVE = 0;
    const BLOCK = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 
        'email',
        'password',
        'name',
        'gender',
        'phone',
        'age',
        'address',
        'avatar',
        'status',
        'slug',
        'is_delete',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at']; 
    
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id');
    }

    public function viewStatus()
    {
        $return = '';
        if($this->status == self::ACTIVE) {
            $return = 'Active';
        }
        if($this->status == self::BLOCK) {
            $return = 'Block';
        }
        return $return;
    }

    public function getGender()
    {
        $return = [
            self::MALE => 'Male',
            self::FEMALE => 'Female',
        ];
        return $return;
    }
}
