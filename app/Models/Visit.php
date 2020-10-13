<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Visit
 * @package App\Models
 * @version September 28, 2020, 8:28 am UTC
 *
 * @property \App\Models\Patient $patient
 * @property integer $patient_id
 * @property string $visit_date
 * @property string $complaint
 * @property string $diagnosis
 * @property string $medication
 */
class Visit extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'visits';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'patient_id',
        'visit_date',
        'complaint',
        'diagnosis',
        'medication'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'visit_date' => 'date',
        'complaint' => 'string',
        'diagnosis' => 'string',
        'medication' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'visit_date' => 'required',
        'complaint' => 'nullable|string|max:191',
        'diagnosis' => 'nullable|string|max:191',
        'medication' => 'nullable|string|max:191',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function patient()
    {
        return $this->belongsTo(\App\Models\Patient::class, 'patient_id');
    }
}
