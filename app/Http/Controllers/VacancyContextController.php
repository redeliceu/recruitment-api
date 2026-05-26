<?php

namespace App\Http\Controllers;

use App\Models\VacancyContext;
use Illuminate\Http\Request;

class VacancyContextController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255|unique:vacancies_context,label',
        ]);

        $context = VacancyContext::create($validated);

        return response()->json([
            'message' => 'Contexto criado com sucesso',
            'data' => $context
        ], 201);
    }

    public function index()
    {
        $contexts = VacancyContext::all();

        return response()->json([
            'data' => $contexts
        ], 200);
    }

    public function show($id)
    {
        $context = VacancyContext::find($id);

        if (!$context) {
            return response()->json([
                'message' => 'Contexto não encontrado'
            ], 404);
        }

        return response()->json([
            'data' => $context
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $context = VacancyContext::find($id);

        if (!$context) {
            return response()->json([
                'message' => 'Contexto não encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'label' => 'sometimes|required|string|max:255|unique:vacancies_context,label,' . $id,
        ]);

        $context->update($validated);

        return response()->json([
            'message' => 'Contexto atualizado com sucesso',
            'data' => $context
        ], 200);
    }

    public function destroy($id)
    {
        $context = VacancyContext::find($id);

        if (!$context) {
            return response()->json([
                'message' => 'Contexto não encontrado'
            ], 404);
        }

        $context->delete();

        return response()->json([
            'message' => 'Contexto deletado com sucesso'
        ], 200);
    }
}
