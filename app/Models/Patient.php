<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Patient
 * @package App\Models
 * @version September 26, 2020, 2:51 am UTC
 *
 * @property string $registration_number
 * @property string $title
 * @property string $name
 * @property string $birth_date
 * @property string $birth_place
 * @property string $age
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $gender
 */
class Patient extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'patients';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'registration_number',
        'name',
        'birth_date',
        'age',
        'address',
        'phone',
        'email',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'registration_number' => 'string',
        'name' => 'string',
        'birth_date' => 'date',
        'age' => 'string',
        'address' => 'string',
        'phone' => 'string',
        'email' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'registration_number' => 'required|max:10|unique:patients',
        'name' => 'required',
        'address' => 'required',
    ];

    /**
     * Get the visits for the patient
     */
    public function visits()
    {
        return $this->hasMany('App\Models\Visit');
    }

    /**
     * Get the last visit for the patient
     */
    public function orderedVisits()
    {
        return $this->hasMany('App\Models\Visit')
            ->orderBy('visit_date', 'desc');
    }
}
