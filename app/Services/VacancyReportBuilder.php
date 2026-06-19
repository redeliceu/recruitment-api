<?php

namespace App\Services;

class VacancyReportBuilder
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function build(array $data): string
    {
        $vacancies = $data['vacancies']['items'];

        $totalVacancies = count($vacancies);

        $totalPositions = collect($vacancies)
            ->sum('number_of_vacancies');

        return view(
            'emails.weekly-vacancies',
            [
                'vacancies' => $vacancies,
                'generatedAt' => $data['generated_at'],
                'totalVacancies' => $totalVacancies,
                'totalPositions' => $totalPositions
            ]
        )->render();
    }
}
