<?php

namespace App\Contexts\Security\Infrastructure\Controllers;

use App\Contexts\Shared\Infrastructure\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadUsuarioDigitalAssetController extends Controller
{
    public function __invoke(string $directory, string $filename): BinaryFileResponse
    {
        if (!in_array($directory, ['fotos', 'firmas'])) {
            abort(404);
        }

        $path = "usuarios/{$directory}/{$filename}";

        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }

        return response()->download(Storage::disk('local')->path($path), null, [], 'inline');
    }
}