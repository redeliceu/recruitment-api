<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancies';

    protected $fillable = [
        'label',
        'is_active',
        'status',
        'category_id',
        'salary',
        'description',
        'number_of_vacancies',
    ];

    public function category()
    {
        return $this->belongsTo(VacancyCategory::class, 'category_id');
    }

    public function status()
    {
        return $this->belongsTo(VacancyStatus::class, 'status');
    }
}
