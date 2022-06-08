<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
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
            'room_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'room_id.required' => 'The room field is required.',
        ];
    }

}
