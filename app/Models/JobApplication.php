<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $table = 'job_applications';

    protected $fillable = [
        'name',
        'job_name',
        'number_phone',
        'email',
        'location',
        'neighborhood',
        'linkedin_url',
        'has_previous_application',
        'has_experience',
        'salary_intention',
        'starts',
        'cv_url'
    ];
}
