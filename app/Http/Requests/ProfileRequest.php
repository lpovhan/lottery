<?php

namespace App\Http\Requests;

use App\Traits\CryptTrait;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;


class ProfileRequest extends FormRequest
{
    use CryptTrait;

    public $user;

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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function validationData()
    {
        $link = $this->route()->parameter('link');
        if ($user = self::decrypt($link)){
            $this->user = $user;
        }
        return parent::validationData();
    }
}
