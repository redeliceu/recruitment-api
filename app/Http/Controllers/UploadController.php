<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json([
                'error' => 'Nenhum arquivo enviado'
            ], 400);
        }

        $file = $request->file('file');

        // Gera nome único
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Salva em storage/app/public/uploads
        $path = $file->storeAs(
            'uploads',
            $fileName,
            'public'
        );

        return response()->json([
            'fileName' => $fileName,
            'path' => env('APP_URL') . '/storage/' . $path,
        ]);
    }

    public function delete(Request $request)
    {
        $fileName = $request->input('fileName');

        if (!$fileName) {
            return response()->json([
                'error' => 'Nome do arquivo é obrigatório'
            ], 400);
        }

        $filePath = 'uploads/' . $fileName;

        if (!\Storage::disk('public')->exists($filePath)) {
            return response()->json([
                'error' => 'Arquivo não encontrado'
            ], 404);
        }

        \Storage::disk('public')->delete($filePath);

        return response()->json([
            'message' => 'Arquivo deletado com sucesso'
        ]);
    }
}
