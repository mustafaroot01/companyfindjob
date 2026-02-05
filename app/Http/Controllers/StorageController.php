<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    /**
     * Serve files from the public storage disk.
     */
    public function show(string $path)
    {
        $fullPath = storage_path('app/public/'.$path);

        if (! file_exists($fullPath)) {
            abort(404);
        }

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        $contentType = $mimeTypes[$extension] ?? mime_content_type($fullPath);
        $content = file_get_contents($fullPath);

        return response($content, 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="'.basename($fullPath).'"',
        ]);
    }
}
