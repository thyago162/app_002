<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormLoja extends FormRequest
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
            'nome' => 'required|string|max:40|min:3',
            'email' => 'required|email|string'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo NOME é obrigatório',
            'valor.string' => 'Formato inválido para o campo NOME',
            'nome.min' => 'Tamanho mínimo para o campo NOME é de 3 caracteres',
            'nome.max' => 'Tamanho máximo para o campo NOME é de 60 caracteres',
            'valor.required' => 'O campo VALOR é obrigatório',
            'valor.integer' => 'Formato inválido para o campo VALOR',
            'valor.min' => 'Tamanho mínimo para o campo VALOR é de 2 digitos',
            'nome.max' => 'Tamanho máximo para o campo VALOR é de 6 digitos',
        ];
    }
}
