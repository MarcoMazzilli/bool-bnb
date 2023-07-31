@extends('layouts.app')

@section('content')

<div class="container" id="inboxMessages">
  <h1 class="py-4">Inbox appartamenti</h1>

  {{-- SEARCHBAR --}}
  <div class="py-3 input-group w-25">
    <form action="{{ route('messages.searchByName')}}" method="POST">
      @csrf
      <div class="d-flex gap-1">
        @if (count($messages) != 0)
        <input id="searchbar" type="text" class="form-control" placeholder="Cerca un appartamento" name="search">
        <button class="btn mvm-button">Cerca</button>
        @else
        <button class="btn border bg-success text-white">Torna all'inbox</button>
        @endif
      </div>
      </form>
  </div>
  {{-- SEARCHBAR --}}
  @if (count($messages) != 0)
<table class="table">

  <thead>
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Nome Appartamento</th>
      <th scope="col">Oggetto del messagio</th>
      <th scope="col">Email</th>
      <th scope="col">Dettagli</th>
    </tr>
  </thead>

  @endif
  <tbody>
      @forelse ($messages as $message)

      <tr class="single-message" data-bs-toggle="modal" data-bs-target="#{{$message->id}}">

        <td>
          @if (!$message->message_read)
          <span class="badge text-bg-danger">Unread</span>
          @else
          <span class="badge text-bg-success">Read</span>
          @endif
        </td>

        <td>{{ $message->apartment->name}}</td>
        <td>{{ $message->object }}</td>
        <td>{{ $message->author_email }}</td>
        <td>
          <button type="button" class="btn inbox mvm-button" data-bs-toggle="modal" data-bs-target="#{{$message->id}}"><i class="fa-solid fa-message"></i></button>
        </td>

      </tr>

    {{-- modal --}}
  </tbody>
  <div class="modal fade" id="{{ $message->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{$message->object}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>{{$message->text}}</p>
        </div>
        <div class="modal-body border">
            <small>Email: {{$message->author_email}}</small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn mvm-button" data-bs-dismiss="modal">Chiudi</button>
            {{--  form --}}
            <form action="{{route('messages.toggleMessage', ['id_message' => $message->id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-success">
                @if (!$message->message_read)
                Segna come letto
                @else
                Segna come da leggere
                @endif
              </button>
            </form>
            {{--  form --}}
          </div>
        </div>
      </div>
    </div>
    {{-- modal --}}

    @empty
    <div class="alert alert-warning" role="alert">
      Non ci sono messaggi per questo appartamento
  </div>

    @endforelse
  </table>

</div>

@endsection
