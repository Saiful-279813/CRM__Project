<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'customer_name' => 'required|min:3|max:50',
          'customer_father' => 'required|min:3|max:50',
          'customer_phone' => 'required|unique:customers,customer_phone',
          'customer_email' => 'required|unique:customers,customer_email',
          'visa_number' => 'required|unique:customers,visa_number',
          'passport_number' => 'required|unique:customers,passport_number',
          'customer_address' => 'required',
          'total_cost' => 'required|numeric',
          'payment' => 'required|numeric',
          'due' => 'required|numeric',
          'place_of_issue' => 'required',
          'visa_type' => 'required',
          'visa_name' => 'required',
          'visa_remarks' => 'required',
          'from_date' => 'required',
          'to_date' => 'required',
          'passport_image' => 'required',
          'visa_image' => 'required',
          'customer_photo' => 'required',
        ];
    }
}
