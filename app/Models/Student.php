<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'score',
        'teacher_id'
    ];

    public function contact()
    {
        // hasOne merupakan relasi one to one
        return $this->hasOne(Contact::class);
    }

    public function teacher()
    {
        //belongsTo merupakan relasi invers
        return $this->belongsTo(Teacher::class);
    }

    public function activities()
    {
        //belongsToMany merupakan relasi many to many
        return $this->belongsToMany(Activity::class);
    }
}
