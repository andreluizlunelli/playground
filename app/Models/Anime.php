<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    /** @use HasFactory<\Database\Factories\AnimeFactory> */
    use HasFactory;

    protected $guarded = [];
}
