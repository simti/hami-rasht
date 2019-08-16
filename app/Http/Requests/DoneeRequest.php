<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
                  'file_number' => 'required|max:45',
                  'full_name' => 'required|string|max:90',
                  'father_name' => 'required|string|max:45',
                  'birth_date' => 'required|string|regex:/\d{4}-\d{2}-\d{2}/',
                  'birth_certificate_id' => 'required|string|max:10|unique:donees',
                  'national_id'  => 'required|string|size:10|unique:donees',
                  'bank_account_number' => 'required',
                  'bank_card_number' => 'required|max:16',
                  'bank_account_owner' => 'required|max:90',
                  'bank_name' => 'required|max:45',
                  'bank_branch_name' => 'required|max:45',
                  'education' => 'required',
                  'gender' => 'required',
                  'membership_start_date' => 'required|string|regex:/\d{4}-\d{2}-\d{2}/',
                  'address' => 'required',
                  'phone' => 'required|size:11',
                  'mobile' => 'required|size:11',
                  'organization_branch' => 'required',
                  'number_of_disabled_members_in_family' => 'required',
                  'number_of_family_members' => 'required',
                  'output_type' => 'required',
                  'reasons_to_help' => 'required',
                  'donors.*.money' => 'sometimes|required_if:donors.*.type,1',
                  'donors.*.no_money' => 'sometimes|required_if:donors.*.type,2|required_if:donors.*.type,3',
              ];
              return $rules;
            }
        case 'PUT':
        case 'PATCH':
            {
              $donee_id = $this->route('donee_id');
              $rules = [
                'file_number' => 'required|max:45',
                'full_name' => 'required|string|max:90',
                'father_name' => 'required|string|max:45',
                'birth_date' => 'required|string|regex:/\d{4}-\d{2}-\d{2}/',
                'birth_certificate_id' => ['required|string',Rule::unique('donees', 'birth_certificate_id')->ignore($donee_id)],
                'national_id' => ['required|string|size:10',Rule::unique('donees', 'birth_certificate_id')->ignore($donee_id)],
                'bank_account_number' => 'required',
                'bank_card_number' => 'required|max:16',
                'bank_account_owner' => 'required|max:90',
                'bank_name' => 'required|max:45',
                'bank_branch_name' => 'required|max:45',
                'education' => 'required',
                'gender' => 'required',
                'membership_start_date' => 'required|string|regex:/\d{4}-\d{2}-\d{2}/',
                'address' => 'required',
                'phone' => 'required|size:11',
                'mobile' => 'required|size:11',
                'organization_branch' => 'required',
                'number_of_disabled_members_in_family' => 'required',
                'number_of_family_members' => 'required',
                'output_type' => 'required',
                'reasons_to_help' => 'required',
                'donors.*.money' => 'sometimes|required_if:donors.type,1',
                'donors.*.no_money' => 'sometimes|required_if:donors.type,2|required_if:donors.type,3',
            ];
              return $rules;
            }
        default:
            break;
      }
    }

}
