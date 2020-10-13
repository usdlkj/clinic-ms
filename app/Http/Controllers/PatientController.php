<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\CreatePatientVisitRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Repositories\PatientRepository;
use App\Repositories\VisitRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Patient;
use App\DataTables\PatientsDataTable;
use Illuminate\Http\Request;
use Flash;
use Response;

class PatientController extends AppBaseController
{
    /** @var  PatientRepository */
    private $patientRepository;

    /** @var  VisitRepository */
    private $visitRepository;

    public function __construct(PatientRepository $patientRepo, VisitRepository $visitRepo)
    {
        $this->patientRepository = $patientRepo;
        $this->visitRepository = $visitRepo;
    }

    /**
     * Display a listing of the Patient.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $patients = $this->patientRepository->all();
        foreach ($patients as $patient) {
            $patient['last_visit'] = '';
            $patient['complaint'] = '';
            $patient['diagnosis'] = '';
            $patient['medication'] =  '';
            if (count($patient->visits) > 0) {
                $patient['last_visit'] = date_format($patient->orderedVisits[0]->visit_date, 'd-m-Y');
                $patient['complaint'] = $patient->orderedVisits[0]->complaint;
                $patient['diagnosis'] = $patient->orderedVisits[0]->diagnosis;
                $patient['medication'] = $patient->orderedVisits[0]->medication;
            }
        }

        return view('patients.index')
            ->with('patients', $patients);
    }

    /**
     * Show the form for creating a new Patient.
     *
     * @return Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created Patient in storage.
     *
     * @param CreatePatientRequest $request
     *
     * @return Response
     */
    public function store(CreatePatientRequest $request)
    {
        $input = $request->all();

        $patient = $this->patientRepository->create($input);

        Flash::success('Patient saved successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * Store new Patient and his Visit
     * 
     * @param CreatePatientVisitRequest $request
     * 
     * @return Response
     */

    public function storePatientVisit(CreatePatientVisitRequest $request)
    {
        $input = $request->all();

        $patient = $this->patientRepository->create([
            'registration_number'   => $input['registration_number'],
            'name'                  => $input['name'],
            'birth_date'            => $input['birth_date'],
            'age'                   => $input['age'],
            'address'               => $input['address'],
            'phone'                 => $input['phone'],
            'email'                 => $input['email']
        ]);

        $visit = $this->visitRepository->create([
            'patient_id'    => $patient->id,
            'visit_date'    => $input['visit_date'],
            'complaint'     => $input['complaint'],
            'diagnosis'     => $input['diagnosis'],
            'medication'    => $input['medication']
        ]);

        Flash::success('Patient saved successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * Display the specified Patient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $patient = $this->patientRepository->find($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }

        return view('patients.show')->with('patient', $patient);
    }

    /**
     * Show the form for editing the specified Patient.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $patient = $this->patientRepository->find($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }

        return view('patients.edit')->with('patient', $patient);
    }

    /**
     * Update the specified Patient in storage.
     *
     * @param int $id
     * @param UpdatePatientRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePatientRequest $request)
    {
        $patient = $this->patientRepository->find($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }

        $input = $request->all();

        $patient = $this->patientRepository->update([
            'name'          => $input['name'],
            'birth_date'    => $input['birth_date'],
            'age'           => $input['age'],
            'address'       => $input['address'],
            'phone'         => $input['phone'],
            'email'         => $input['email']
        ], $id);

        Flash::success('Patient updated successfully.');

        return redirect(route('patients.index'));
    }

    /**
     * Remove the specified Patient from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $patient = $this->patientRepository->find($id);

        if (empty($patient)) {
            Flash::error('Patient not found');

            return redirect(route('patients.index'));
        }

        $this->patientRepository->delete($id);

        Flash::success('Patient deleted successfully.');

        return redirect(route('patients.index'));
    }
}