<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyStatus extends Model
{
    protected $table = 'vacancies_status';
    protected $fillable = ['label'];
}
