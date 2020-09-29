<?php

namespace App\Repositories;

use App\Models\Visit;
use App\Repositories\BaseRepository;

/**
 * Class VisitRepository
 * @package App\Repositories
 * @version September 28, 2020, 8:28 am UTC
*/

class VisitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'patient_id',
        'visit_date',
        'complaint',
        'diagnosis',
        'medication'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Visit::class;
    }
}
