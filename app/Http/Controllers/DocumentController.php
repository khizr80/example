<?php

namespace App\Http\Controllers;

use App\Services\DocumentConverter;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $converter;

    public function __construct(DocumentConverter $converter)
    {
        $this->converter = $converter;
    }

    public function convert(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:docx|max:5120', // 5MB max
        ]);

        try {
            $file = $request->file('document');
            $path = $file->store('temp');
            $fullPath = storage_path('app/' . $path);

            $markdown = $this->converter->docxToMarkdown($fullPath);

            // Clean up
            unlink($fullPath);

            return response()->json([
                'status' => 'success',
                'markdown' => $markdown
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}