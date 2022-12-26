<?php

namespace App\Http\Requests;

use App\Rules\ImageURL;
use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth("web")->check();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            "user_id" => auth("web")->id()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "artist_name" => ["required"],
            "name" => ["required"],
            'cover' => ["nullable", "active_url", new ImageURL],
            "user_id" => ["required", "exists:users,id"],
            "description" => ["nullable", "string"],
        ];
    }
}
