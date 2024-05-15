<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;


class BaseRequest extends FormRequest
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
        return [
            'tagged' => 'required',
            'fromdate' =>'nullable|integer|min:0',
            'todate' =>'nullable|integer|min:0',

        ];
    }

    public function messages()
    {
        return [
            'tagged.required' => 'Tagged is required.',
            'fromdate.integer' => 'Fromdate must be a UNIX timestamp but is not required.',
            'todate.integer' => 'Todate must be a UNIX timestamp but is not required.',
            'fromdate.min' => 'Fromdate must be a positive UNIX timestamp but is not required.',
            'todate.min' => 'Todate must be a positive UNIX timestamp but is not required.',            
        ];
    }

    protected function failedValidation(Validator $validator) : void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $errors = $validator->errors()
        ], 422));
        
    }

    protected function passedValidation()
    {

        if ($this->has('tagged') && $this->filled('tagged')) {
            
            $tagged = preg_replace('/[, ]+/', '; ', $this->input('tagged'));
            $this->merge([
                'tagged' => $tagged,
            ]);
        }

    }

   
}
