@extends('layouts.app')

@section('content')
<div class="bg-image" id="form-new-user">

  <div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrazione nuovo utente') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                      @csrf
                        {{-- Input nome --}}
                        <div class="mb-4 row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                          <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>
                            {{-- Input cognome --}}
                            <div class="mb-4 row">
                              <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>
                              {{-- TODO: Gestire il messaggio di errore --}}
                              <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control @error('name') is-invalid @enderror" name="last_name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            {{-- TODO: Gestire il messaggio di errore --}}
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                          </div>
                        </div>
                        {{-- Input data di nascita --}}
                        <div class="mb-4 row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>
                          {{-- TODO: Gestire il messaggio di errore --}}
                          <div class="col-md-6">
                            <input id="date_of_birth" type="date" class="form-control @error('name') is-invalid @enderror" name="date_of_birth" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            {{-- TODO: Gestire il messaggio di errore --}}
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                            </div>
                            {{-- Input email --}}
                            <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </div>
                        </div>
                        {{-- Input password --}}
                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                              @error('password')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Input conferma password --}}
                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                          </div>

                          <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4 d-flex justify-content-end gap-3">
                              {{-- button back to home --}}
                              <a href="{{ route('home') }}"><button type="button" class="btn">Torna alla home</button></a>

                              {{-- button register --}}
                              <button type="submit" class="btn">
                                {{ __('Registrati') }}
                              </button>

                            </div>
                          </div>
                        </form>
                </div>
            </div>
          </div>
        </div>
</div>
</div>
@endsection
