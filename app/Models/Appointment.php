<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Appointment extends Model
{
    use HasFactory;
    const PENDING = 0;
    const PROCESSED = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'appointments';

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
        'patient_id',
        'doctor_id',
        'qr_id',
        'code', 
        'date_time',
        'note',
        'status',
        'is_delete',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function patient()
    {
        return $this->belongsTo('App\Models\User', 'patient_id')
        ->where('is_delete', 0)
        ->where(function ($query) {
            $query->whereHas('role', function ($roleQuery) {
                $roleQuery->where('permission', Config::get('constants.PERMISSION_BY_ROLE.PATIENT'));
            });
        });
    }

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

    public function viewStatus()
    {
        $return = '';
        if($this->status == self::PENDING) {
            $return = 'Pending';
        }
        if($this->status == self::PROCESSED) {
            $return = 'Processed';
        }
        return $return;
    }
}
