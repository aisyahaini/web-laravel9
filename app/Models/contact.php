<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    use HasFactory;

    public function student()
    {
        //belongsTo merupakan relasi invers
        return $this->belongsTo(Student::class);
    }
}
