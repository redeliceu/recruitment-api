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
                'vacancy_id' => 'required|integer|exists:vacancies,id',
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

    public function getAll()
    {
        try {
            $applications = JobApplication::all();

            return response()->json([
                'data' => $applications
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|integer|in:0,1,2,3,4,5,6,7,8',
            ]);

            $application = JobApplication::find($id);

            if (! $application) {
                return response()->json([
                    'message' => 'Job application not found.'
                ], 404);
            }

            $application->status = $validatedData['status'];
            $application->save();

            return response()->json([
                'message' => 'Status updated successfully',
                'data' => $application
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Invalid status value. Accepted values are 0, 1, 2, 3, 4, 5, 6, 7, 8.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage() ?? 'Internal server error'
            ], 500);
        }
    }

    public function exportCvsInZip(Request $request)
    {
        try {

            $ids = $request->input('ids', []);

            if (empty($ids)) {
                return response()->json([
                    'message' => 'No application IDs provided.'
                ], 400);
            }

            $applications = JobApplication::whereIn('id', $ids)
                ->whereNotNull('cv_url')
                ->get();

            if ($applications->isEmpty()) {
                return response()->json([
                    'message' => 'No CVs found.'
                ], 404);
            }

            $zipFileName = 'cvs_' . time() . '.zip';
            $zipFilePath = storage_path('app/' . $zipFileName);

            $zip = new \ZipArchive();

            if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {

                return response()->json([
                    'message' => 'Failed to create ZIP file.'
                ], 500);
            }

            foreach ($applications as $application) {

                $relativePath = str_replace(
                    '/storage/',
                    '',
                    parse_url($application->cv_url, PHP_URL_PATH)
                );

                $fullPath = storage_path('app/public/' . $relativePath);

                if (file_exists($fullPath)) {

                    $zip->addFile(
                        $fullPath,
                        basename($fullPath)
                    );
                }
            }

            $zip->close();

            return response()
                ->download($zipFilePath)
                ->deleteFileAfterSend(true);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
