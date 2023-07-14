@extends('layouts.app')

@section('content')

<div class="container p-5">
  <h3>Lista appartamenti</h3>

  <table class="table mb-5">
    <thead>
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Luogo appartamento</th>
        <th scope="col">Servizi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($apartments as $apartment)

          <tr>
            <th>{{ $apartment->id }}</th>
            <td>{{ $apartment->name }}</td>
            <td>{{ $apartment->address }}</td>
            <td>{{ $apartment->services }}</td>
          </tr>

      @endforeach
    </tbody>
  </table>

  <h3>Lista appartamenti sponsorizzati</h3>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Luogo appartamento</th>
        <th scope="col">Servizi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($apartments as $apartment)

          <tr>
            <th>{{ $apartment->id }}</th>
            <td>{{ $apartment->name }}</td>
            <td>{{ $apartment->address }}</td>
            <td>{{ $apartment->services }}</td>
          </tr>

      @endforeach
    </tbody>
  </table>
</div>

@endsection

