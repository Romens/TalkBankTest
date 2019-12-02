<?php

namespace App\Http\Requests\Promocode;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PromocodeStoreRequest
 * @package App\Http\Requests\Promocode
 * @property-read int $value
 * @property-read int $max_use_count
 * @property-read string|null $name
 */
class PromocodeStoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|integer|between:0,100',
            'max_use_count' => 'required|integer|min:1',
            'name' => 'string|nullable',
        ];
    }
}
