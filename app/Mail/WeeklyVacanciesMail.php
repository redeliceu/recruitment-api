<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyVacanciesMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $data,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Relatório Semanal de Vagas em Aberto',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.weekly-vacancies',
            with: [
                'vacancies' => $this->data['vacancies'],
                'weekday' => $this->data['weekday'],
                'day' => $this->data['day'],
                'month' => $this->data['month'],
                'totalVacancies' => $this->data['totalVacancies'],
                'totalPositions' => $this->data['totalPositions'],
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
