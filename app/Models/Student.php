<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'photo'
    ];

    public function profile()
    {
        return $this->hasOne(StudentProfile::class); 
    }

    public function payments()
    {
        return $this->hasMany(StudentPayment::class);
    }
}
