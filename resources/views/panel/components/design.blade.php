<div class="col-lg-3">
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">{{ $design->name }}</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end">
          <a class="dropdown-item" href="{{ route('panel.designs.delete', $design->id) }}">Delete</a>
        </div>
      </div>
    </div>

    <div class="card-body d-flex flex-column align-items-center justify-content-between">
      <div style="background-image: url({{ url($design->getFirstMediaUrl('design')) }}); background-size: contain; background-repeat: no-repeat; background-position: center; width: 200px; height: 200px;" class="mb-4"></div>

      <form method="post" action="{{ route('panel.designs.rename', $design->id) }}" class="form-inline">
        @csrf

        <div class="form-group mx-sm-3">
          <input type="text" name="name" value="{{ $design->name }}" placeholder="Name" class="form-control">
        </div>
        <input type="submit" class="btn btn-primary" value="Save">
      </form>
    </div>
  </div>
</div>
