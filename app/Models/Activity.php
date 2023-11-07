<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function students()
    {
        // belongToMany relasi many to many
        return $this->belongsToMany(Student::class);
    }
}
