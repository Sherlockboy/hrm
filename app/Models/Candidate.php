<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'min_salary',
        'max_salary',
        'linkedin_url',
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearch(Builder $query, string $searchQuery): Builder
    {
        // Remove extra spaces in search query
        $searchQuery = Str::squish($searchQuery);

        // Prepare search query for sql like operation
        $searchQuery = "%$searchQuery%";

        return $query->where(
            fn(Builder $query) => $query->whereRaw("CONCAT(first_name, ' ', last_name) like ?", $searchQuery)
                ->orWhere('position', 'like', $searchQuery)
                ->orWhere('status', 'like', $searchQuery)
                ->orWhereHas(
                    'skills',
                    fn(Builder $query) => $query->where('name', 'like', $searchQuery)
                )
        );
    }
}
