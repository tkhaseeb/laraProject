<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $table = 'student_profile';

    protected $fillable = [
        'student_id',
        'city',
        'state',
        'country',
        'postal_code'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
