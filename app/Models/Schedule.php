<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Schedule extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedules';

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
        'doctor_id',
        'frame_ids',
        'detail',
        'is_delete',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    
    public function doctor()
    {
        return $this->belongsTo('App\Models\User', 'doctor_id')
        ->where('is_delete', 0)
        ->where(function ($query) {
            $query->whereHas('role', function ($roleQuery) {
                $roleQuery->where('permission', Config::get('constants.PERMISSION_BY_ROLE.DOCTOR'));
            });
        });
    }
}
