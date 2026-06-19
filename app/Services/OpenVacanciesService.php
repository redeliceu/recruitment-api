<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenVacanciesService
{
    public function get(): array
    {
        $response = Http::timeout(30)
            ->acceptJson()
            ->get(config('services.open_vacancies.url'));

        if (! $response->successful()) {
            throw new RuntimeException('Erro ao consultar a API de vagas.');
        }

        return $response->json();
    }
}
