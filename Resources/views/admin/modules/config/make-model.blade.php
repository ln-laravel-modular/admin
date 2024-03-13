<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Entities <small>模型实体</small></h3>
    <form method="POST" class="card-tools mb-0">
      @csrf
      <input type="hidden" class="form-control" name='_target' value="make-model">
      <div class="input-group input-group-sm" style="width: 280px;">
        <div class="input-group-prepend">
          <span class="input-group-text">{{ $moduleConfig['name'] }}</span>
        </div>
        <input type="hidden" class="form-control" name='model-prepend' value="{{ $moduleConfig['name'] }}">
        <input type="text" name="model" class="form-control float-right" placeholder="Make Model">
        <div class="input-group-append">
          <button type="submit" class="btn btn-default">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
  <!-- /.card-header -->
  <div class="card-body d-none">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
      content.</p>
  </div>
  <ul class="list-group list-group-flush">
    @foreach ($moduleConfig['entities'] ?? [] as $file)
      <li class="list-group-item">
        <div class="form-group mb-0">
          <div class="icheck-primary d-inline">
            <input type="checkbox" disabled>
            <label for="checkboxPrimary2">
              {{ basename($file) }}
            </label>
          </div>
        </div>
      </li>
    @endforeach
  </ul>

  <div class="card-footer">
    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
  </div>
</div>
