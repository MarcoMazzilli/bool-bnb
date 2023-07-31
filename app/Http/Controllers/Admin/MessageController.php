<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;



class MessageController extends Controller
{
  public function getMessages(){

    $apartments = Apartment::where('user_id' , Auth::id());
    $apartmentsId = Apartment::select('id')->where('user_id', Auth::id())->get();
    $messagesCount = Message::WhereIn('apartment_id',$apartmentsId)->count();
    $messages = Message::WhereIn('apartment_id',$apartmentsId)
    ->orderBy('message_read')
    ->get();

    return view('admin.apartments.apartment-messages',compact('apartments','messages'));
  }

  public function toggleMessageReadUnread(Request $request){

    $data = $request->all();
    $message = Message::find($data['id_message']);

    !$message->message_read ? $message->message_read = 1 : $message->message_read = 0;

    $message->update($data);

    return back();
  }

  public function searchByApartment(Request $request){


    $toSearch = $request['search'];

    $messages = Message::whereHas('apartment', function (Builder $query){
      $query->where('user_id', Auth::id());
    })
    ->whereHas('apartment', function (Builder $query) use ($toSearch) {
      $query->where('name', 'like', '%'. $toSearch . '%');
    })->get();

    return view('admin.apartments.apartment-messages',compact('messages'));
  }
}
