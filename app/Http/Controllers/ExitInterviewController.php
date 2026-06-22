<?php

namespace App\Http\Controllers;

use App\Models\ExitInterview;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ExitInterviewController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'departamento' => 'required|string|max:255',
                'funcao' => 'required|string|max:255',
                'escolaridade' => 'required|string|max:255',
                'telefone' => 'required|string|max:50',
                'unidade' => 'required|string|max:255',
                'motivo_desligamento' => 'required|string|max:255',
                'motivo_pedido_demissao' => 'nullable|string|max:255',
                'motivo_pedido_demissao_outro_texto' => 'nullable|string',
                'evitar_pedido_demissao' => 'nullable|string|max:255',
                'evitar_pedido_demissao_outro_texto' => 'nullable|string',
                'relacao_lideranca' => 'required|string|max:255',
                'relacao_colegas' => 'required|string|max:255',
                'recebeu_feedback' => 'required|string|max:255',
                'metas_claras_integracao' => 'required|string|max:255',
                'cultura_empresa' => 'required|string|max:255',
                'comunicacao_interna' => 'required|string|max:255',
                'atividades_condizentes' => 'required|string|max:255',
                'discriminacao_assedio' => 'required|string|max:255',
                'discriminacao_assedio_detalhe' => 'nullable|string',
                'recomendaria_empresa' => 'required|string|max:255',
                'ambiente_trabalho' => 'nullable|string',
            ]);

            $exitInterview = ExitInterview::create($validatedData);

            return response()->json([
                'message' => 'Exit interview registered successfully',
                'data' => $exitInterview,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error',
            ], 500);
        }
    }

    public function index()
    {
        try {
            $exitInterviews = ExitInterview::all();

            return response()->json([
                'data' => $exitInterviews,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error',
            ], 500);
        }
    }
}
