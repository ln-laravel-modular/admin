<div class="card card-default">
  <div class="card-header">
    <h3 class="card-title">Factories <small>模型工厂</small></h3>
    <form method="POST" class="card-tools mb-0">
      @csrf
      <div class="form-group d-none">
        <label>Config Target</label>
        <input type="text" class="form-control" name='_target' value="make-factory">
      </div>
      <div class="input-group input-group-sm" style="width: 280px;">
        <input type="text" name="factory" class="form-control float-right" placeholder="Make Factory">
        <div class="input-group-append">
          <span class="input-group-text">Factory</span>
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
    @foreach ($moduleConfig['factories'] ?? [] as $file)
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
