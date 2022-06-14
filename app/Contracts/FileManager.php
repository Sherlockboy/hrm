<?php

namespace App\Contracts;

use App\Models\Candidate;
use Illuminate\Http\Request;

interface FileManager
{
    public function upload(Candidate $candidate, Request $request): array;
    public function generateFileName(Candidate $candidate, Request $request): string;
    public function delete(Candidate $candidate): void;
}
