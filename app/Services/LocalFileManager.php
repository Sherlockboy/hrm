<?php

namespace App\Services;

use App\Contracts\FileManager;
use App\Models\Candidate;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocalFileManager implements FileManager
{
    public function upload(Candidate $candidate, Request $request): array
    {
        $name = $this->generateFileName($candidate, $request);
        $request->file('cv')->storeAs('public/' . config('filesystems.candidate_files_directory'), $name);

        return [
            'name' => $name,
            'collection_name' => config('filesystems.candidate_files_directory'),
        ];
    }

    public function generateFileName(Candidate $candidate, Request $request): string
    {
        return Str::lower(
            $candidate->first_name
            . '-' . $candidate->last_name
            . '-' . Str::uuid()
            . '.' . $request->file('cv')->extension()
        );
    }

    public function delete(Candidate $candidate): void
    {
        $candidate->files->each(fn(File $file) => Storage::delete($file->getStoragePath()));
    }
}
