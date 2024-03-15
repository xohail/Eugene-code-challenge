<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'specialty' => '',
            'clinic_name' => '',
            'clinic_house' => '',
            'clinic_street' => '',
            'clinic_suburb' => '',
            'clinic_postcode' => '',
            'clinic_state' => '',
            'clinic_address' => '',
        ];
    }
}
