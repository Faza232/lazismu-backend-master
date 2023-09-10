<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateKasbankRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|min:4',
            'penerima' => 'required|string|min:4',
            'nobuktikas' => Rule::unique('kasbanks')->where(fn ($query) => $query->where('cabang_id', $this->cabang_id)),
            'tanggal' => 'required',
            'ref' => 'nullable',
            'coadebit_id' => 'required|integer|exists:coas,id',
            'coakredit_id' => 'required|integer|exists:coas,id',
            'jumlah' => 'required|integer',
            'cabang_id' => 'required|integer|exists:cabangs,id',

        ];
    }
}
