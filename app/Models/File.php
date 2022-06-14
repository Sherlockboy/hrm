<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'collection_name'];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    public function getStoragePath(): string
    {
        return 'public/' . $this->attributes['collection_name'] . '/' . $this->attributes['name'];
    }

    public function getPathAttribute(): string
    {
        return asset('storage/' . $this->attributes['collection_name'] . '/' . $this->attributes['name']);
    }
}
