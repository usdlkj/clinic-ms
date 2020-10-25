<?php

namespace App\Http\Controllers\API;

use App\Models\Visit;
use App\Repositories\VisitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VisitController
 * @package App\Http\Controllers\API
 */

class VisitAPIController extends AppBaseController
{
    /** @var  VisitRepository */
    private $visitRepository;

    public function __construct(VisitRepository $visitRepo)
    {
        $this->visitRepository = $visitRepo;
    }

    /**
     * Display a listing of the Visit.
     * GET|HEAD /visits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $visits = $this->visitsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($visits->toArray(), 'Visit retrieved successfully');
    }

    /**
     * Display a listing of distinct Visits' Diagnosis
     */
    public function getDistinctDiagnosis(Request $request)
    {
        $diagnosis = DB::table('visits')
            ->select('diagnosis')
            ->distinct()
            ->get();

        $id = 1;
        $results = [];
        foreach ($diagnosis as $d) {
            array_push($results, [
                'id' => $id,
                'text' => $d->diagnosis
            ]);
            $id++;
        }
        $response = [
            'results' => $results,
            'pagination' => [
                'more' => false
            ]
        ];

        return $response;
    }

    /**
     * Store a newly created Visit in storage.
     * POST /visits
     *
     * @param CreateVisitAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVisitAPIRequest $request)
    {
        $input = $request->all();

        $visits = $this->visitsRepository->create($input);

        return $this->sendResponse($visits->toArray(), 'Visit saved successfully');
    }

    /**
     * Display the specified Visit.
     * GET|HEAD /visits/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Visit $visits */
        $visits = $this->visitsRepository->find($id);

        if (empty($visits)) {
            return $this->sendError('Visit not found');
        }

        return $this->sendResponse($visits->toArray(), 'Visit retrieved successfully');
    }

    /**
     * Update the specified Visit in storage.
     * PUT/PATCH /visits/{id}
     *
     * @param int $id
     * @param UpdateVisitAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVisitAPIRequest $request)
    {
        $input = $request->all();

        /** @var Visit $visits */
        $visits = $this->visitsRepository->find($id);

        if (empty($visits)) {
            return $this->sendError('Visit not found');
        }

        $visits = $this->visitsRepository->update($input, $id);

        return $this->sendResponse($visits->toArray(), 'Visit updated successfully');
    }

    /**
     * Remove the specified Visit from storage.
     * DELETE /visits/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Visit $visits */
        $visits = $this->visitsRepository->find($id);

        if (empty($visits)) {
            return $this->sendError('Visit not found');
        }

        $visits->delete();

        return $this->sendSuccess('Visit deleted successfully');
    }
}
