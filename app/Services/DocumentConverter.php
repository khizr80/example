<?php

namespace App\Services;

use PhpOffice\PhpWord\IOFactory;
use League\HTMLToMarkdown\HtmlConverter;

class DocumentConverter
{
    protected $htmlConverter;

    public function __construct()
    {
        $this->htmlConverter = new HtmlConverter([
            'strip_tags' => true,
            'header_style' => 'atx'
        ]);
    }

    public function docxToMarkdown($filePath)
    {
        try {
            // Load DOCX
            $phpWord = IOFactory::load($filePath);
            
            // Convert to HTML first
            $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
            
            // Save HTML temporarily
            $tempFile = storage_path('app/temp/' . uniqid() . '.html');
            $htmlWriter->save($tempFile);
            
            // Read HTML content
            $html = file_get_contents($tempFile);
            
            // Convert HTML to Markdown
            $markdown = $this->htmlConverter->convert($html);
            
            // Clean up temp file
            unlink($tempFile);
            
            return $markdown;
            
        } catch (\Exception $e) {
            throw new \Exception("Error converting document: " . $e->getMessage());
        }
    }
}