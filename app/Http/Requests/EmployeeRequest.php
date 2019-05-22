<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EmployeeRequest
 * @package App\Http\Requests
 */
class EmployeeRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'company' => 'required|exists:companies,id',
            'email' => 'email|max:100|unique:employees|nullable',
            'phone' => 'string|max:50|nullable',
        ];

        if (!$this->isMethod('post')) {
            $rules = array_merge($rules, [
                'email' => 'email|max:100|unique:employees,email,' . $this->employee->id . '|nullable',
            ]);
        }

        return $rules;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->input('first_name');
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->input('last_name');
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return (int)$this->input('company');
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->input('email');
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->input('phone');
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'company_id' => $this->getCompanyId(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
        ];
    }
}
