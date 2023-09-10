<?php

namespace App\Http\Requests;

use App\Models\Muzaki;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class UpdateMuzakiRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        $muzaki = Muzaki::find($request->id);
        return [
            'nama' => 'required|string',
            'nik' => 'required|string',
            'alamat' => 'required|string',
            'noTelp' => 'required|string',
            'npwp' => 'required|string'
        ];
    }
}
