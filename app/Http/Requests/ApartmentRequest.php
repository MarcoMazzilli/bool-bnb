<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|min:3|max:100',
            'address'=>'required|min:3|max:100',
            'n_of_bed' => 'required|numeric|between:1,20',
            'n_of_room'=> 'required|numeric|between:1,10',
            'n_of_bathroom'=> 'required|numeric|between:1,10',
            'apartment_size'=> 'required|numeric|between:15,1000',
            'type'=> 'required|min:3|max:50'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è un campo obbligatorio',
            'name.min' => 'Il nome deve avere almeno :min caratteri',
            'name.max' => 'Il nome non deve avere più di :max caratteri',
            'address.required' => "L'indirizzo è un campo obbligatorio",
            'address.min' =>  "L'indirizzo deve avere almeno :min caratteri",
            'address.max' =>  "L'indirizzo non deve avere più di :max caratteri",
            'n_of_room.required' => 'Il numero di camere è un campo obbligatorio',
            'n_of_room.numeric' => 'Il numero di camere deve essere un numero',
            'n_of_room.between' => 'Il numero di camere deve essere compreso tra 1 e 10',
            'n_of_room.min' => 'Il numero di camere deve essere almeno :min',
            'n_of_room.max' => 'Il numero di camere deve essere inferiore a :max',
            'n_of_bed.required' => 'Il numero di letti è un campo obbligatorio',
            'n_of_bed.numeric' => 'Il numero di letti  deve essere un numero',
            'n_of_bed.min' => 'Il numero di letti  deve essere almeno :min',
            'n_of_bed.max' => 'Il numero di letti deve essere inferiore a :max',
            'n_of_bed.between' => 'Il numero di letti deve essere compreso tra 1 e 20',
            'n_of_bathroom.required' => 'Il numero di bagni è un campo obbligatorio',
            'n_of_bathroom.numeric' => 'Il numero di bagni deve essere un numero',
            'n_of_bathroom.min' => 'Il numero di bagni deve essere :min',
            'n_of_bathroom.max' => 'Il numero di bagni deve essere  :max',
            'n_of_bathroom.between' => 'Il numero di bagni deve essere compreso tra 1 e 10',
            'apartment_size.required' => 'I metri quadri è un campo obbligatorio',
            'apartment_size.numeric' => 'I metri quadri devono essere un numero',
            'apartment_size.between' => 'I metri quadri devono essere compresi tra 15mq e 1000mq',
            'apartment_size.min' => 'I metri quadri devono essere almeno :min',
            'apartment_size.max' => 'I metri quadri devono essere massimo  :max',
            'type.required' => 'La tipologia è un campo obbligatorio',
            'type.min' => 'La tipologia deve avere almeno :min caratteri',
            'type.max' => 'La tipologia non deve avere più di :max caratteri',
        ];
    }
}
