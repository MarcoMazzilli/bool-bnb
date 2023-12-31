
<!-- Button trigger modal -->
<button type="button" title="Visibile" class="btn btn-outline-warning text-dark" data-bs-toggle="modal" data-bs-target="#modal{{ $apartment->id }}">
    @if (!$apartment->visible)
      <span class="d-none d-xl-inline-block">Rendi visibile</span>
      <i class="fa-regular fa-eye d-xl-none"></i>
    @else
      <span class="d-none d-xl-inline-block">Nascondi</span>
      <i class="fa-regular fa-eye-slash d-xl-none"></i>
    @endif
  </button>

  <!-- Modal -->
  <div class="modal fade" id="modal{{ $apartment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Modifica la visibilità di : {{ $apartment->name }}</strong></p>
        </div>
        <div class="modal-footer">

            <form class="d-inline" action="{{ route('admin.toggleVisible',['apartment_id'=> $apartment->id]) }}" method="POST">
                @csrf

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annulla</button>
                @if (!$apartment->visible)
                <button class="btn btn-warning text-white" type="submit">Rendi visibile</button>
                @else
                <button class="btn btn-warning text-white" type="submit">Nascondi</button>
                @endif
            </form>
        </div>
      </div>
    </div>
  </div>
