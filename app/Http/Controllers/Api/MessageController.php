<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
  public function store(Request $request){

    $data = $request->all();

    $validator = Validator::make($data,
    [
      'author_first_name' => 'required|min:2|max:255',
      'author_last_name' => 'required|min:2|max:255',
      'text' => 'required|min:2|max:255',
      'author_email' => 'required|min:2|max:255',
      'object' => 'required|min:2|max:255'
    ],
    [
      'author_first_name.min' => 'Il nome deve contenere :min caratteri',
      'author_last_name.min' => 'Il cognome deve contenere :min caratteri',
      'author_firt_name.max' => 'Il nome non puo contenere più di :max caratteri',
      'author_last_name.max' => 'Il cognome non puo contenere più di :max caratteri',
      'author_first_name.required' => 'Il nome è un campo obbligatorio',
      'author_last_name.required' => 'Il cognome è un campo obbligatorio',
      'text.required' => 'Il messaggio è un campo obbligatorio',
      'object.required' => 'L\'oggetto è un campo obbligatorio',
      'author_email.required' => 'La mail è un campo obbligatorio',
    ],
  );

  if ($validator->fails()) {
    $success = false;
    $errors = $validator->errors();
    return response()->json(compact('success','errors','data'));
  }

  $new_message = new Message();
  $new_message->fill($data);
  $new_message->save();

    $success = true;
    return response()->json(compact('data','success','new_message'));
  }
}
