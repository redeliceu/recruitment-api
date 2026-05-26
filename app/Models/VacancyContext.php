<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacancyContext extends Model
{
    protected $table = 'vacancies_context';
    protected $fillable = ['label'];
}
