<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:schools,name',
        ]);

        $school = Schools::create($validated);

        return response()->json([
            'message' => 'Escola criada com sucesso',
            'data' => $school
        ], 201);
    }

    public function index()
    {
        $schools = Schools::all();

        return response()->json([
            'data' => $schools
        ], 200);
    }

    public function show($id)
    {
        $school = Schools::find($id);

        if (!$school) {
            return response()->json([
                'message' => 'Escola não encontrada'
            ], 404);
        }

        return response()->json([
            'data' => $school
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $school = Schools::find($id);

        if (!$school) {
            return response()->json([
                'message' => 'Escola não encontrada'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:schools,name,' . $id,
        ]);

        $school->update($validated);

        return response()->json([
            'message' => 'Escola atualizada com sucesso',
            'data' => $school
        ], 200);
    }

    public function destroy($id)
    {
        $school = Schools::find($id);

        if (!$school) {
            return response()->json([
                'message' => 'Escola não encontrada'
            ], 404);
        }

        $school->delete();

        return response()->json([
            'message' => 'Escola deletada com sucesso'
        ], 200);
    }
}
