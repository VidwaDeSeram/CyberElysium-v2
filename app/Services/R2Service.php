<?php

namespace App\Services;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\Credentials;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class R2Service
{
    private $s3Client;

    public function __construct()
    {
        $credentials = new Credentials(
            env('CLOUDFLARE_ACCESS_KEY_ID'),
            env('CLOUDFLARE_ACCESS_KEY_SECRET')
        );

        $this->s3Client = new S3Client([
            'region' => 'auto',
            'version' => 'latest',
            'endpoint' => env('CLOUDFLARE_R2_ENDPOINT'),
            'credentials' => $credentials,
        ]);
    }

    public function generatePresignedUrl($fileName, $domain, $contentType, $publicRead = true)
    {
        $key = strtolower($domain) . '/' . Str::uuid() . '-' . $fileName;
        $bucket = env('CLOUDFLARE_R2_BUCKET_NAME');

        $cmd = $this->s3Client->getCommand('PutObject', [
            'Bucket' => $bucket,
            'Key' => $key,
            'ContentType' => $contentType,
        ]);

        try {
            $request = $this->s3Client->createPresignedRequest($cmd, '+1 hour');
            $presignedUrl = (string)$request->getUri();
            $r2url = "https://pub-a9a956148eae4bf2935ed98de6e1d143.r2.dev/{$bucket}"."/{$key}";

            Log::info("Generated presigned URL for {$fileName} in {$domain} domain with {$contentType} content type");

            return [
                'presignedUrl' => $presignedUrl,
                'r2url' => $r2url,
            ];
        } catch (AwsException $e) {
            Log::error("Error generating presigned URL: " . $e->getMessage());
            throw new \Exception("Could not generate presigned URL: " . $e->getMessage());
        }
    }
}

