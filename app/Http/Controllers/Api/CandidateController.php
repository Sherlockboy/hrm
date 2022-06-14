<?php

namespace App\Http\Controllers\Api;

use App\Contracts\FileManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Candidate\CreateRequest;
use App\Http\Requests\Candidate\UpdateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CandidateController extends Controller
{
    public function __construct(private FileManager $fileManager)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return CandidateResource::collection(Candidate::all());
    }

    public function store(CreateRequest $request): CandidateResource
    {
        $candidate = Candidate::create($request->validated());

        if ($request->has('skills')) {
            $candidate->skills()->attach($request->input('skills'));
        }

        if ($request->hasFile('cv')) {
            $candidate->files()->create($this->fileManager->upload($candidate, $request));
        }

        return new CandidateResource($candidate);
    }

    public function show(Candidate $candidate): CandidateResource
    {
        $candidate->load('skills', 'files', 'comments.status');

        return new CandidateResource($candidate);
    }

    public function update(UpdateRequest $request, Candidate $candidate): CandidateResource
    {
        $candidate->update($request->validated());

        if ($request->has('skills')) {
            $candidate->skills()->sync($request->input('skills'));
        }

        if ($request->hasFile('cv')) {
            $candidate->files()->create($this->fileManager->upload($candidate, $request));
        }

        return new CandidateResource($candidate);
    }

    public function destroy(Candidate $candidate): JsonResponse
    {
        $this->fileManager->delete($candidate);

        $candidate->delete();

        return response()->json([
            'message' => "Candidate deleted."
        ]);
    }
}
