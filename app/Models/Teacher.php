<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function students()
    {
        // hasMany merupakan relasi one to many
        return $this->hasMany(Student::class);
    }
}
