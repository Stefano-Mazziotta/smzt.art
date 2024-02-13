<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreAlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return
            [
                'title' => 'required|string|max:32',
                'description' => 'required|string|min:14|max:100',
                'featuredPhoto' => 'required|image|mimes:jpg,webp|max:2048',
                // 'photos' => 'required|array',
                // 'photos.*' => 'image|mimes:jpg,webp|max:2048',
                // 'labelIds' => 'required|array',
                // 'labelIds.*' => 'numeric'
            ];
    }
}
