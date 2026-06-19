<?php

namespace App\Console\Commands;

use App\Mail\WeeklyVacanciesMail;
use App\Services\OpenVacanciesService;
use App\Services\VacancyReportService;
use Illuminate\Console\Command;
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


            $report = $builder->build($api->get());

            $recipients = $report['recipients'];

            unset($report['recipients']);

            foreach ($recipients as $recipient) {

                Mail::to($recipient['email'])
                    ->queue(
                        new WeeklyVacanciesMail($report)
                    );
            }

            $this->info('Relatório enviado.');

            return self::SUCCESS;
        } catch (Throwable $e) {

            $this->error($e->getMessage());

            report($e);

            return self::FAILURE;
        }
    }
}
