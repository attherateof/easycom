<?php

namespace App\Http\Requests\Catalog;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Image\Base64 as ImageBase64Rule;
use App\Rules\SlugRule;

class Category extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $unique = Rule::unique('categories');
        if ($this->id) {
            $unique = $unique->ignore($this->id);
        }

        return [
            'status' => 'boolean',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:2000',
            'banner' => ['nullable', 'string', new ImageBase64Rule],
            'anchor' => 'boolean',
            'display_type' => 'integer',
            'slug' => ['required', 'string', 'max:100', new SlugRule, $unique],
            'meta_title' => 'nullable|string|max:100',
            'meta_description' => 'nullable|string|max:170',
            'meta_image' => ['nullable', 'string', new ImageBase64Rule],
            'parent_id' => 'nullable|integer',
            'sort_order' => 'nullable|integer',
        ];
    }
}
