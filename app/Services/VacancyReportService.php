<?php

namespace App\Services;

use Carbon\Carbon;

class VacancyReportService
{
    public function build(array $data): array
    {
        $vacancies = $data['vacancies']['items'];

        Carbon::setLocale('pt_BR');

        $generatedAt = Carbon::parse($data['generated_at']);

        $weekday = ucfirst($generatedAt->translatedFormat('l'));
        $day = $generatedAt->day;
        $month = ucfirst($generatedAt->translatedFormat('F'));

        $totalVacancies = count($vacancies);

        $totalPositions = collect($vacancies)
            ->sum('number_of_vacancies');

        $html = view(
            'emails.weekly-vacancies',
            [
                'vacancies' => $vacancies,
                'weekday' => $weekday,
                'day' => $day,
                'month' => $month,
                'totalVacancies' => $totalVacancies,
                'totalPositions' => $totalPositions,
            ]
        )->render();

        return [
            'recipients' => $data['recipients']['items'],
            'vacancies' => $vacancies,
            'weekday' => $weekday,
            'day' => $day,
            'month' => $month,
            'totalVacancies' => $totalVacancies,
            'totalPositions' => $totalPositions,
        ];
    }
}
