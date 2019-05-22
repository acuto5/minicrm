<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class CompanyCreateRequest
 * @package App\Http\Requests
 */
class CompanyCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        return [
            'name' => 'required|string|max:50|unique:companies',
            'email' => 'email|nullable|max:100',
            'logo' => 'dimensions:min_width=100,min_height=100|mimes:jpeg,jpg',
            'website' => "string|nullable|regex:$regex|max:100",
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->input('name');
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->input('email');
    }

    /**
     * @return UploadedFile|null
     */
    public function getLogo(): ?UploadedFile
    {
        return $this->file('logo');
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->input('website');
    }
}
