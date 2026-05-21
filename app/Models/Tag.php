<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'slug'])]
class Tag extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
