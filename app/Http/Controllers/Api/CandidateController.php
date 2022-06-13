<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\CreateRequest;
use App\Http\Requests\Candidate\UpdateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CandidateController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CandidateResource::collection(Candidate::all());
    }

    public function store(CreateRequest $request): CandidateResource
    {
        $candidate = Candidate::create($request->validated());

        return new CandidateResource($candidate);
    }

    public function show(Candidate $candidate): CandidateResource
    {
        return new CandidateResource($candidate);
    }

    public function update(UpdateRequest $request, Candidate $candidate): CandidateResource
    {
        $candidate->update($request->validated());

        return new CandidateResource($candidate);
    }

    public function destroy(Candidate $candidate): JsonResponse
    {
        $candidate->delete();

        return response()->json([
            'message' => "Candidate deleted."
        ]);
    }
}
