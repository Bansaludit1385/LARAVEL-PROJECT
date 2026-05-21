<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeProblem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'difficulty',
        'category',
        'description',
        'starter_code_py',
        'starter_code_cpp',
        'starter_code_java',
    ];
}
