<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DoneeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      switch ($this->method()) {
        case 'GET':
        case 'DELETE':
            {
                return [];
            }
        case 'POST':
            {
              $rules = [
                  'full_name' => 'required|max:191',
                  'father_name' => 'required|max:65535',
                  'national_id'  => 'max:65535',
                  'birth_certificate_id' => 'required',
                  'phone' => 'required',
                  'mobile' => 'required',
                  'gender' => 'required',
                  'education' => 'required',
                  'birth_date' => 'required',
                  'address' => 'required',
                  'bank_account_number' => 'required',
                  'bank_card_number' => 'required',
                  'bank_account_owner' => 'required',
                  'bank_name' => 'required',
                  'bank_branch_name' => 'required',
                  'file_number' => 'required',
                  'membership_start_date' => 'required',
                  'organization_branch' => 'required',
                  'number_of_disabled_members_in_family' => 'required',
                  'number_of_family_members' => 'required',
                  'disabled' => 'required',
                  'output_type' => 'required',
                  'reasons_to_help' => 'required',
              ];
              return $rules;
            }
        case 'PUT':
        case 'PATCH':
            {
              $rules = [
                'full_name' => 'required|max:191',
                'father_name' => 'required|max:65535',
                'national_id'  => 'max:65535',
                'birth_certificate_id' => 'required',
                'phone' => 'required',
                'mobile' => 'required',
                'gender' => 'required',
                'education' => 'required',
                'birth_date' => 'required',
                'address' => 'required',
                'bank_account_number' => 'required',
                'bank_card_number' => 'required',
                'bank_account_owner' => 'required',
                'bank_name' => 'required',
                'bank_branch_name' => 'required',
                'file_number' => 'required',
                'membership_start_date' => 'required',
                'organization_branch' => 'required',
                'number_of_disabled_members_in_family' => 'required',
                'number_of_family_members' => 'required',
                'disabled' => 'required',
                'output_type' => 'required',
                'reasons_to_help' => 'required',
              ];
              return $rules;
            }
        default:
            break;
      }
    }

}
