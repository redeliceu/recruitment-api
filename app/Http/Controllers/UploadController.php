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

        // Só documentos/imagens de currículo. Bloqueia .php e afins, que o nginx executaria em /storage
        $request->validate([
            'file' => [
                'required', 'file', 'max:10240',
                'extensions:pdf,doc,docx,jpg,jpeg,png,heic',
                'mimes:pdf,doc,docx,jpg,jpeg,png,heic',
            ],
        ]);

        $file = $request->file('file');

        // Gera nome único no servidor; nunca usar o nome enviado pelo cliente
        $fileName = time() . '_' . \Illuminate\Support\Str::random(16) . '.' . strtolower($file->getClientOriginalExtension());

        // Salva em storage/app/public/uploads
        $path = $file->storeAs(
            'uploads',
            $fileName,
            'public'
        );

        return response()->json([
            'fileName' => $fileName,
            'path' => asset('storage/' . $path),
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

        // Impede caminhos como "../": só nomes de arquivo dentro de uploads/
        $filePath = 'uploads/' . basename($fileName);

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
