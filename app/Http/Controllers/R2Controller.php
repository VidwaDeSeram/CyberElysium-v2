<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeneratePresignedUrlRequest;
use App\Services\R2Service;
use Illuminate\Http\JsonResponse;

class R2Controller extends Controller
{
    private $r2Service;

    public function __construct(R2Service $r2Service)
    {
        $this->r2Service = $r2Service;
    }

    public function generatePresignedUrl(GeneratePresignedUrlRequest $request): JsonResponse
    {
        $data = $request->validated();

        try {
            $result = $this->r2Service->generatePresignedUrl(
                $data['fileName'],
                $data['domain'],
                $data['contentType']
            );

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
