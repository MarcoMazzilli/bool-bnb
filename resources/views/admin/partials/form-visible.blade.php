
<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal{{ $id }}">
    visibile
  </button>

  <!-- Modal -->
  <div class="modal fade" id="modal{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{ $message }}
        </div>
        <div class="modal-footer">

            <form class="d-inline" action="{{ route('admin.apartments.update', $apartment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="visible" class="form-label">visibile</label>
                <select name="visible" id="visible">
                    <option value=1> visibile</option>
                    <option value=0 > non visibile</option>
                </select>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button class="btn btn-danger" type="submit">modifica</button>
        </form>
        </div>
      </div>
    </div>
  </div>
