<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required|min:12',
            'alamat' => 'required',
            '*.*.bahan_baku_id' => 'required',
            '*.*.jumlah' => 'required|numeric',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach ($this->request->get('bahan_baku') as $key => $value) {
            $messages['bahan_baku.'.$key.'.jumlah.required'] = 'Jumlah '.($key+1).' tidak boleh kosong';
            $messages['bahan_baku.'.$key.'.bahan_baku_id.required'] = 'Bahan Baku '.($key+1).' tidak boleh kosong';

            $messages['bahan_baku.'.$key.'.jumlah.numeric'] = 'Jumlah '.($key+1).' harus berupa number';
        }

        return $messages;
    }
}
