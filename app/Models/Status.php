<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public const FIRST_CONTACT = 1;
    public const INTERVIEW = 2;
    public const TECH_ASSIGNMENT = 3;
    public const REJECTED = 4;
    public const HIRED = 5;

}
