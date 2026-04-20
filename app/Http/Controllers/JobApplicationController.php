<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {


        try {
            // Validação básica dos dados
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'job_name' => 'required|string|max:255',
                'number_phone' => 'required|nullable|string|max:20',
                'email' => 'required|email|unique:job_applications,email',
                'location' => 'required|string|max:255',
                'neighborhood' => 'nullable|string|max:255',
                'linkedin_url' => 'nullable|url|max:255',
                'has_previous_application' => 'required|boolean',
                'has_experience' => 'required|boolean',
                'salary_intention' => 'required|string|max:50',
                'starts' => 'required|string|max:255',
                'cv_url' => 'required|nullable|string|max:255',
            ], [
                'email.email' => 'The email must be a valid email address.',
                'email.unique' => 'The email has already been taken.',
                'linkedin_url.url' => 'The LinkedIn URL must be a valid URL.',
                'cv_url.text' => 'The CV URL is required.',
            ]);

            // Cria o registro no banco de dados
            $jobApplication = JobApplication::create($validatedData);

            return response()->json([
                'message' => 'Application created successfully',
                'data' => $jobApplication
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }
}
