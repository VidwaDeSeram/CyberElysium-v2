<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePresignedUrlRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust this based on your authorization logic
    }

    public function rules()
    {
        return [
            'fileName' => 'required|string',
            'domain' => 'required|string',
            'contentType' => 'required|string',
        ];
    }
}
