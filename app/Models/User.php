<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Model
{
    use HasFactory;
    use sluggable;
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
        'adress',
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
        return $this->belongsTo('App\Models\Role');
    }

    public function viewStatus()
    {
        $return = '';
        if($this->status == 0) {
            $return = 'Active';
        }
        if($this->status == 1) {
            $return = 'Block';
        }
        return $return;
    }
}
