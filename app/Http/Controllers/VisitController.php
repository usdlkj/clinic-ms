<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVisitRequest;
use App\Http\Requests\UpdateVisitRequest;
use App\Repositories\VisitRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VisitController extends AppBaseController
{
    /** @var  VisitRepository */
    private $visitRepository;

    public function __construct(VisitRepository $visitRepo)
    {
        $this->visitRepository = $visitRepo;
    }

    /**
     * Display a listing of the Visit.
     *
     * @param Request $request
     * @param $id
     *
     * @return Response
     */
    public function index(Request $request, $id)
    {
        $patient = \App\Models\Patient::find($id);
        if (is_null($patient)) {
            Flash::error('Pasien tidak ditemukan');
            return redirect(route('patients.index'));
        }
        
        $visits = $this->visitRepository->all(['patient_id' => $id]);

        return view('visits.index')
            ->with('patient', $patient)
            ->with('visits', $visits);
    }

    /**
     * Show the form for creating a new Visit.
     * 
     * @param $id
     *
     * @return Response
     */
    public function create($id)
    {
        $patient = \App\Models\Patient::find($id);
        if (is_null($patient)) {
            Flash::error('Pasien tidak ditemukan');
            return redirect(route('patients.index'));
        }

        return view('visits.create')
            ->with('patient', $patient);
    }

    /**
     * Store a newly created Visit in storage.
     *
     * @param CreateVisitRequest $request
     * @param $id
     *
     * @return Response
     */
    public function store(CreateVisitRequest $request, $id)
    {
        $input = $request->all();

        $visit = $this->visitRepository->create($input);

        Flash::success('Visit saved successfully.');

        return redirect(route('visits.index', $id));
    }

    /**
     * Display the specified Visit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            Flash::error('Kunjungan tidak ditemukan');

            return redirect(route('visits.index'));
        }

        return view('visits.show')
            ->with('visit', $visit)
            ->with('patient', $visit->patient);
    }

    /**
     * Show the form for editing the specified Visit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            Flash::error('Kunjungan tidak ditemukan');

            return redirect(route('visits.index'));
        }

        return view('visits.edit')
            ->with('visit', $visit)
            ->with('patient', $visit->patient);
    }

    /**
     * Update the specified Visit in storage.
     *
     * @param int $id
     * @param UpdateVisitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVisitRequest $request)
    {
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            Flash::error('Kunjungan tidak ditemukan');

            return redirect(route('visits.index', $visit->patient_id));
        }

        $visit = $this->visitRepository->update($request->all(), $id);

        Flash::success('Visit updated successfully.');

        return redirect(route('visits.index', $visit->patient_id));
    }

    /**
     * Remove the specified Visit from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            Flash::error('Kunjungan tidak ditemukan');

            return redirect(route('patients.index'));
        }

        $this->visitRepository->delete($id);

        Flash::success('Kunjungan sukses dihapus');

        return redirect(route('visits.index', $visit->patient_id));
    }
}
