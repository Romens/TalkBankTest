<?php

namespace App\Http\Requests\Promocode;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PromocodeGetRequest
 * @package App\Http\Requests\Promocode
 * @property-read string $name
 */
class PromocodeGetRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|exists:promocodes,name',
        ];
    }
}
