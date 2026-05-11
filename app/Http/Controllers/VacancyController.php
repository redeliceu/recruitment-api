<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;
use App\Models\VacancyCategory;

class VacancyController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'label' => 'required|string|max:255',
                'is_active' => 'sometimes|required|boolean',
                'category_id' => 'required|integer|exists:vacancies_category,id',
                'salary' => 'nullable|numeric|min:0',
                'description' => 'nullable|string',
                'number_of_vacancies' => 'required|integer|min:1',
            ]);

            $vacancy = Vacancy::create($validatedData);

            return response()->json([
                'message' => 'Vacancy created successfully',
                'data' => $vacancy
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'label' => 'sometimes|required|string|max:255',
                'is_active' => 'sometimes|required|boolean',
                'category_id' => 'sometimes|required|integer|exists:vacancies_category,id',
                'salary' => 'sometimes|nullable|numeric|min:0',
                'description' => 'sometimes|nullable|string',
                'number_of_vacancies' => 'sometimes|required|integer|min:1',
            ]);

            $vacancy = Vacancy::find($id);

            if (!$vacancy) {
                return response()->json([
                    'message' => 'Vacancy not found.'
                ], 404);
            }

            $vacancy->update($validatedData);

            return response()->json([
                'message' => 'Vacancy updated successfully',
                'data' => $vacancy
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $query = Vacancy::with(['category', 'status']);

            if ($request->has('category_id') && $request->category_id) {
                $query->where('category_id', $request->category_id);
            }

            $vacancies = $query->get();

            return response()->json([
                'data' => $vacancies
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }

    public function metadata()
    {
        try {
            $categories = VacancyCategory::all();
            //$statuses = VacancyStatus::all();

            return response()->json([
                'categories' => $categories,
                //'statuses' => $statuses,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $vacancy = Vacancy::find($id);

            if (! $vacancy) {
                return response()->json([
                    'message' => 'Vacancy not found.'
                ], 404);
            }

            $vacancy->delete();

            return response()->json([
                'message' => 'Vacancy deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }
}
