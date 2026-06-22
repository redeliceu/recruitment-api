<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exit_interviews', function (Blueprint $table) {
            $table->id();

            $table->string('departamento');
            $table->string('funcao');
            $table->string('escolaridade');
            $table->string('telefone');
            $table->string('unidade');

            $table->string('motivo_desligamento');
            $table->string('motivo_pedido_demissao')->nullable();
            $table->text('motivo_pedido_demissao_outro_texto')->nullable();

            $table->string('evitar_pedido_demissao')->nullable();
            $table->text('evitar_pedido_demissao_outro_texto')->nullable();

            $table->string('relacao_lideranca');
            $table->string('relacao_colegas');
            $table->string('recebeu_feedback');
            $table->string('metas_claras_integracao');
            $table->string('cultura_empresa');
            $table->string('comunicacao_interna');
            $table->string('atividades_condizentes');
            $table->string('discriminacao_assedio');
            $table->text('discriminacao_assedio_detalhe')->nullable();
            $table->string('recomendaria_empresa');
            $table->text('ambiente_trabalho')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exit_interviews');
    }
};
