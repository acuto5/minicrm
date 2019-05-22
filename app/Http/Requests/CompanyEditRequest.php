<?php

namespace App\Http\Requests;

/**
 * Class CompanyEditRequest
 * @package App\Http\Requests
 */
class CompanyEditRequest extends CompanyCreateRequest
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
        $rules = parent::rules();
        $rules = array_merge($rules, [
            'name' => 'required|string|max:50|unique:companies,name,' . $this->company->id,
        ]);

        return $rules;
    }
}
