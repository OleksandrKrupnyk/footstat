<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfileClubUpdateRequest
 *
 * @property integer $club
 * @property integer $opponent
 * @package App\Http\Requests
 * @author Alex.Krupnik <krupnik_a@ukr.net>
 * @copyright (c), Thread
 */
class ProfileClubCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'club' => ['required', 'integer'],
            'opponent' => ['nullable', 'integer', 'different:club']
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'opponent.different' => 'The Opponent Club field and Favorite Club must be different.',
        ];
    }
}
