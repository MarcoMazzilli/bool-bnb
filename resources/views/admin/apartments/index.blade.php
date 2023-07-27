@extends('layouts.app')

@section('content')
    {{-- @dd($apartmentsVisible); --}}

    <div class="container my_overflow">
        <h3>Lista appartamenti visibili</h3>
        @if ($apartmentsVisible->where('visible', 1)->count())
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Luogo appartamento</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartmentsVisible as $apartment)
                        <tr>
                            <th>{{ $apartment->id }}</th>
                            <td>{{ $apartment->name }}</td>
                            <td>{{ $apartment->address }}</td>
                            <td>

                                @include('admin.partials.form-visible', [
                                    'title' => 'Modifica',
                                    'apartment' => $apartment,
                                    'route' => route('admin.apartments.update', $apartment),
                                ])

                                <a href="{{ route('admin.apartments.show', $apartment) }}"
                                    class="btn btn-outline-primary">Mostra</a>
                                <a href="{{ route('admin.apartments.edit', $apartment) }}"
                                    class="btn btn-outline-secondary">Modifica</a>

                                @include('admin.partials.form-delete', [
                                    'title' => 'Eliminazione Post',
                                    'id' => $apartment->id,
                                    'message' => "Confermi l'eliminazione del appartamento $apartment->name",
                                    'route' => route('admin.apartments.destroy', $apartment),
                                ])

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-end">
                {{ $apartmentsVisible->links() }}
              </div> --}}
        @else
            <div class="alert alert-warning" role="alert">
                Non ci sono appartamenti visibili
            </div>
        @endif

        <h3>Lista appartamenti sponsorizzati</h3>
        @if ($num_sponsorship != 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Luogo appartamento</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($apartmentSponsored as $apartment)
                        {{-- @dd($apartment->sponsorships) --}}
                        {{-- @if (!$apartment->sponsorships) --}}
                        <tr>
                            <th>{{ $apartment->id }}</th>
                            <td>{{ $apartment->name }}</td>
                            <td>{{ $apartment->address }}</td>
                        </tr>
                        {{-- @else --}}
                        {{-- @endif --}}
                    @endforeach

                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-end">
              {{ $apartmentSponsored->links() }}
            </div> --}}
        @else
            <div class="alert alert-warning" role="alert">
                Sponsorizza il tuo primo post!
            </div>
        @endif

        <h3>Lista appartamenti non visibili</h3>
        @if ($apartmentsHidden->where('visible', 0)->count())
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Luogo appartamento</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($apartmentsHidden->where('visible', 0) as $apartment)
                        <tr>
                            <th>{{ $apartment->id }}</th>
                            <td>{{ $apartment->name }}</td>
                            <td>{{ $apartment->address }}</td>
                            <td>
                              @include('admin.partials.form-visible', [
                                'title' => 'Modifica',
                                'apartment' => $apartment,
                                'route' => route('admin.apartments.update', $apartment),
                            ])
                                <a href="{{ route('admin.apartments.show', $apartment) }}"
                                    class="btn btn-outline-primary">Mostra</a>
                                <a href="{{ route('admin.apartments.edit', $apartment) }}"
                                    class="btn btn-outline-secondary">Modifica</a>

                                @include('admin.partials.form-delete', [
                                    'title' => 'Eliminazione Post',
                                    'id' => $apartment->id,
                                    'message' => "Confermi l'eliminazione del appartamento $apartment->name",
                                    'route' => route('admin.apartments.destroy', $apartment),
                                ])
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-end">
              {{ $apartmentsHidden->links() }}
            </div> --}}
        @else
            <div class="alert alert-warning" role="alert">
                Non ci sono appartamenti nascosti
            </div>
        @endif

    </div>
@endsection
