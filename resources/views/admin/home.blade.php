@extends('layouts.app')

@section('content')

<div class="container">

  <h2 class="fs-4 text-secondary my-4">{{ __('Dashboard') }}</h2>

  <p>{{ Auth::user()->name }} utente registrato il {{ Auth::user()->created_at }}</p>

  {{-- -------------------- dash nativa  --}}

    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }} {{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
