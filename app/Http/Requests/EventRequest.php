<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->action['as'] === "event.destroy") {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date.*' => 'sometimes|required|date',
			'event_name' => 'sometimes|required',
			'name' => 'sometimes|required',
			'radio*' => 'sometimes|required',
			'description' => 'sometimes',
			'uuid' => '',
        ];
    }

    public function validated()
    {
        return array_merge($this->all(), [
            'uuid' => Str::uuid()->toString(),
        ]);
    }
}
