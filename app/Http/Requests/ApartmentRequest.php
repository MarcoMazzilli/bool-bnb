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
            'n_of_bed'=> 'required',
            'n_of_room'=> 'required',
            'n_of_bathroom'=> 'required',
            'apartment_size'=> 'required',
            'type'=> 'required'
        ];
    }

    public function messages()
    {
      return[
        'name.required' => 'Il nome è un campo obbligatorio',
        'name.min' => 'Il nome deve avere almeno :min caratteri',
        'name.max' => 'Il nome non deve avere più di :max caratteri',
        'address.required' => "L'indirizzo è un campo obbligatorio",
        'address.min' =>  "L'indirizzo deve avere almeno :min caratteri",
        'address.max' =>  "L'indirizzo non deve avere più di :max caratteri",
        'n_of_room.required' => 'Il numero di camere è un campo obbligatorio',
        'n_of_bed.required' => 'Il numero di letti è un campo obbligatorio',
        'n_of_bathroom.required' => 'Il numero di bagni è un campo obbligatorio',
        'apartment_size.required' => 'I metri quadri è un campo obbligatorio',
        'type.required' => 'La tipologia è un campo obbligatorio',
      ];
    }
}
