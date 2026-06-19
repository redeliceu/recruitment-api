<?php

namespace App\Console\Commands;

use App\Mail\WeeklyVacanciesMail;
use App\Services\OpenVacanciesService;
use App\Services\VacancyReportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class SendWeeklyVacanciesReport extends Command
{
    protected $signature = 'vacancies:weekly-report';

    protected $description = 'Envia relatório semanal de vagas';

    public function handle(
        OpenVacanciesService $api,
        VacancyReportService $builder
    ) {
        try {

            Log::info('Iniciando envio do relatório semanal.');

            $report = $builder->build($api->get());

            $recipients = $report['recipients'];

            unset($report['recipients']);

            foreach ($recipients as $recipient) {
                Log::info("Enviando para {$recipient['email']}");

                try {
                    Mail::to($recipient['email'])
                        ->queue(new WeeklyVacanciesMail($report));

                    $this->info("✔ {$recipient['email']}");
                } catch (\Throwable $e) {
                    report($e);

                    $this->error("Erro ao enviar para {$recipient['email']}: {$e->getMessage()}");
                }
            }

            $this->info('Relatório enviado.');
            Log::info('Relatório semanal enviado com sucesso.');

            return self::SUCCESS;
        } catch (Throwable $e) {

            $this->error($e->getMessage());

            report($e);

            return self::FAILURE;
        }
    }
}
