<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VacancyStatus;

class VacancyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['label' => 'ALINHAMENTO'],
            ['label' => 'DIVULGAÇÃO'],
            ['label' => 'CAPTAÇÃO'],
            ['label' => 'TRIAGEM'],
            ['label' => 'ENTREVISTA E TESTE'],
            ['label' => 'ENTREVISTA FASE 2'],
            ['label' => 'ENVIO DE FEEDBACK'],
            ['label' => 'FINALIZADO'],
            ['label' => 'SUSPENSO'],
        ];

        foreach ($statuses as $status) {
            VacancyStatus::create($status);
        }
    }
}
