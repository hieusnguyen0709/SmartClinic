<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Medicine extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    const BOTTLE = 0;
    const TUBE = 1;
    const PILL = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'medicines';

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
        'category_id',
        'name',
        'instruction',
        'unit',
        'quantity',
        'slug',
        'user_id',
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

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function viewUnit()
    {
        $return = '';
        if($this->unit == self::BOTTLE) {
            $return = 'Bottle';
        }
        if($this->unit == self::TUBE) {
            $return = 'Tube';
        }
        if($this->unit == self::PILL) {
            $return = 'Pill';
        }
        return $return;
    }
}
