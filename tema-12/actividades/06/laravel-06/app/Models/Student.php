<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'birth_date', 'phone', 'city', 'dni', 'email', 'course_id'];

    // Un alumno pertenece a un curso. El nombre del método va en plural y en minúscula.
    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
