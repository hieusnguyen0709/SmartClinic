<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Support\Facades\Config;

class Prescription extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prescriptions';

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
        'name',
        'patient_id',
        'doctor_id',
        'appointment_id',
        'code',
        'medicine',
        'detail',
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

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment', 'appointment_id');
    }

    public function prescriptionMedicines()
    {
        return $this->hasMany('App\Models\PrescriptionMedicine', 'prescription_id')->where('is_delete', 0);
    }
}
