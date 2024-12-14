<?php

namespace App\Http\Requests\Api\V1;

use App\Infrastructure\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2'],
            'content' => ['required', 'string', 'min:10'],
            'is_active' => ['sometimes', 'nullable', 'boolean'],
        ];
    }

    /**
     * Get the post data from the request.
     *
     * @return array<string, string>
     */
    public function getPostData(): array
    {
        return [
            'title' => $this->input('title'),
            'content' => $this->input('content'),
            'is_active' => $this->boolean('is_active'),
        ];
    }
}
