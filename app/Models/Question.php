<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['quiz_id', 'question_text', 'options', 'correct_option', 'points'])]
class Question extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'options' => 'array',
        ];
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
