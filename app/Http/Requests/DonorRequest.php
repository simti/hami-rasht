<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
                    'title' => 'required|max:191',
                    'summary' => 'required|max:65535',
                    'tags'  => 'max:65535',
                    'txt_note' => 'required',
                    'status' => 'required',
                    'category' => 'required',
                ];
                $photos = count($this->input('articleImage'));
                foreach (range(0, $photos) as $index) {
                    $rules['articleImage.' . $index] = 'required|image|mimes:jpeg,png';
                }
                return $rules;
            }
        case 'PUT':
        case 'PATCH':
            {
                $rules = [
                    'title' => 'required|max:191',
                    'summary' => 'required|max:65535',
                    'txt_note' => 'required',
                    'status' => 'required',
                    'category' => 'required',
                    'tags'  => 'max:65535',
                ];
                $photos = count($this->input('articleImage'));
                foreach (range(0, $photos) as $index) {
                    $rules['articleImage.' . $index] = 'image|mimes:jpeg,png';
                }
                return $rules;
            }
        default:
            break;
      }
    }

    public function messages()
    {
        return [
            'title.required' => 'عنوان را وارد نمایید',
            'title.max' => 'طول عنوان از حد مجاز بیشتر است',
            'summary.required' => 'خلاصه مطلب را وارد نمایید',
            'summary.max' => 'متن خلاصه مطلب طولانی تر از حد مجاز است',
            'txt_note.*' => 'متن را وارد نمایید',
            'status.*' => '',
            'category.*' => 'دسته را انتخاب نمایید',
            'articleImage.*' => 'عکس نا معتبر است یا انتخاب نشده'
        ];
    }
}
