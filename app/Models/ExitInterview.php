<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExitInterview extends Model
{
    protected $table = 'exit_interviews';

    protected $fillable = [
        'departamento',
        'funcao',
        'escolaridade',
        'telefone',
        'unidade',
        'motivo_desligamento',
        'motivo_pedido_demissao',
        'motivo_pedido_demissao_outro_texto',
        'evitar_pedido_demissao',
        'evitar_pedido_demissao_outro_texto',
        'relacao_lideranca',
        'relacao_colegas',
        'recebeu_feedback',
        'metas_claras_integracao',
        'cultura_empresa',
        'comunicacao_interna',
        'atividades_condizentes',
        'discriminacao_assedio',
        'discriminacao_assedio_detalhe',
        'recomendaria_empresa',
        'ambiente_trabalho',
    ];
}
