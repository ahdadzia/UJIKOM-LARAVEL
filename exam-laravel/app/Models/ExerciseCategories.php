<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseCategories extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    use HasFactory;

    public function category()
    {
        return $this->hasMany(ExerciseItems::class, 'id', 'category_id');
    }
}
