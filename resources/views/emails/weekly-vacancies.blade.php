<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body style="
        margin:0;
        padding:0;
        background:#F4F6F9;
        font-family:Arial,Helvetica,sans-serif;
    ">

    <table width="100%" cellpadding="0" cellspacing="0" style="
        background:#F4F6F9;
        padding:32px 16px;
    ">

        <tr>

            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;">

                    <tr>

                        <td style="
        background:#1F3864;
        border-radius:10px 10px 0 0;
        padding:28px 32px;
    ">

                            <p style="
        color:#7EAACC;
        font-size:11px;
        font-weight:bold;
        letter-spacing:.1em;
        margin:0 0 10px 0;
    ">

                                REDE LICEU · R&S

                            </p>

                            <h1 style="
        color:#FFFFFF;
        font-size:24px;
        margin:0;
    ">

                                {{ $weekday }}, {{ $day }} de {{ $month }}

                            </h1>

                            <p style="
        color:#AEC6E0;
        margin-top:10px;
        font-size:14px;
    ">

                                Nossa semana começa com
                                <strong>{{ $totalVacancies }}</strong>
                                vagas abertas.

                            </p>

                        </td>

                    </tr>

                    <tr>

                        <td style="
        background:#FFFFFF;
        padding:32px;
    ">

                            <p style="
        font-size:15px;
        color:#444;
        margin-bottom:24px;
    ">

                                Olá!

                                <br><br>

                                Seguem as
                                <strong>{{ $totalVacancies }}</strong>
                                vagas atualmente em aberto,
                                totalizando
                                <strong>{{ $totalPositions }}</strong>
                                {{ $totalPositions == 1 ? 'posição' : 'posições' }}
                                disponíveis.

                            </p>

@foreach($vacancies as $vacancy)

@php
    $metrics = $vacancy['metrics'];
    $badgeColor = $vacancy['number_of_vacancies'] > 1
        ? '#2E75B6'
        : '#F5A623';
@endphp

<div
    style="
        border:1px solid #E8E8E8;
        border-radius:8px;
        padding:20px 24px;
        margin-bottom:12px;
        background:#FFFFFF;
    ">

    <p
        style="
            font-size:11px;
            font-weight:600;
            color:#888888;
            letter-spacing:.08em;
            margin:0 0 6px 0;
            text-transform:uppercase;
        ">

        VAGA

    </p>

    <p
        style="
            font-size:17px;
            font-weight:700;
            color:#1A1A2E;
            margin:0 0 16px 0;
        ">

        {{ $vacancy['label'] }}

    </p>

    <table
        cellpadding="0"
        cellspacing="0"
        border="0"
        width="100%">

        <tr>

            <td
                style="
                    vertical-align:top;
                    padding-right:24px;
                ">

                <p
                    style="
                        font-size:10px;
                        font-weight:600;
                        color:#888888;
                        letter-spacing:.08em;
                        text-transform:uppercase;
                        margin:0 0 4px 0;
                    ">

                    UNIDADE

                </p>

                <p
                    style="
                        font-size:14px;
                        color:#1A1A2E;
                        margin:0;
                    ">

                    {{ $vacancy['school'] ?? '—' }}

                </p>

            </td>

            <td
                style="
                    vertical-align:top;
                    padding-right:24px;
                ">

                <p
                    style="
                        font-size:10px;
                        font-weight:600;
                        color:#888888;
                        letter-spacing:.08em;
                        text-transform:uppercase;
                        margin:0 0 4px 0;
                    ">

                    CATEGORIA

                </p>

                <p
                    style="
                        font-size:14px;
                        color:#1A1A2E;
                        margin:0;
                    ">

                    {{ $vacancy['category'] }}

                </p>

            </td>

            <td style="vertical-align:top;">

                <p
                    style="
                        font-size:10px;
                        font-weight:600;
                        color:#888888;
                        letter-spacing:.08em;
                        text-transform:uppercase;
                        margin:0 0 6px 0;
                    ">

                    POSIÇÕES DISPONÍVEIS

                </p>

                <span
                    style="
                        background-color:{{ $badgeColor }};
                        color:#FFFFFF;
                        font-size:13px;
                        font-weight:700;
                        padding:4px 14px;
                        border-radius:20px;
                        display:inline-block;
                    ">

                    {{ $vacancy['number_of_vacancies'] }}

                    {{ $vacancy['number_of_vacancies'] == 1 ? 'posição' : 'posições' }}

                </span>

            </td>

        </tr>

    </table>

    <table
        cellpadding="0"
        cellspacing="0"
        border="0"
        width="100%"
        style="
            margin-top:16px;
            padding-top:14px;
            border-top:1px solid #F0F0F0;
        ">

        <tr>

            @include('emails.components.metric', [
        'icon' => '📅',
        'value' => $metrics['days_open'],
        'label' => 'DIAS EM ABERTO'
    ])

            @include('emails.components.metric', [
        'icon' => '📋',
        'value' => $metrics['qualified_count'],
        'label' => 'QUALIFICADOS'
    ])

            @include('emails.components.metric', [
        'icon' => '👥',
        'value' => $metrics['curriculum_count'],
        'label' => 'ENTREVISTAS'
    ])

            @include('emails.components.metric', [
        'icon' => '⏱️',
        'value' => number_format($metrics['hours_invested'], 2, '.', ''),
        'label' => 'HORAS'
    ])

            @if($metrics['is_driven'])

            <td
                style="
                    vertical-align:top;
                    white-space:nowrap;
                ">

                <table
                    cellpadding="0"
                    cellspacing="0"
                    border="0">

                    <tr>

                        <td
                            style="
                                font-size:15px;
                                padding-right:5px;
                                vertical-align:middle;
                                color:#22A06B;
                            ">

                            💲

                        </td>

                        <td style="vertical-align:middle;">

                            <p
                                style="
                                    font-size:9px;
                                    font-weight:700;
                                    color:#22A06B;
                                    letter-spacing:.08em;
                                    text-transform:uppercase;
                                    margin:0;
                                ">

                                IMPULSIONADA

                            </p>

                        </td>

                    </tr>

                </table>

            </td>

            @endif

        </tr>

    </table>

</div>

@endforeach

<p
    style="
        font-size:14px;
        color:#666666;
        margin:28px 0 0 0;
        line-height:1.6;
    ">

    Caso conheça candidatos com aderência ao perfil,
    entre em contato com o time de Recrutamento &amp; Seleção.

</p>

<p
    style="
        font-size:14px;
        color:#444444;
        margin:24px 0 0 0;
    ">

    Atenciosamente,

    <br>

    <strong style="color:#1F3864;">

        Rede Liceu

    </strong>

</p>

</td>

</tr>

<!-- RODAPÉ -->

<tr>

    <td
        style="
        background-color:#F0F3F7;
        border-radius:0 0 10px 10px;
        padding:16px 32px;
        text-align:center;
    ">

        <p
            style="
            font-size:12px;
            color:#AAAAAA;
            margin:0;
        ">

            Este e-mail foi enviado automaticamente pelo sistema
            de R&amp;S da Rede Liceu.

        </p>

    </td>

</tr>

</table>

</td>

</tr>

</table>

</body>

</html>
