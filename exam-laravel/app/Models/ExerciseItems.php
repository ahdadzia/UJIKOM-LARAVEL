<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'question',
        'a',
        'b',
        'c',
        'd',
        'answer',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(ExerciseCategories::class, 'category_id', 'id');
    }
}
