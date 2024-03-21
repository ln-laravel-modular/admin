@extends($config['slug'] . '::layouts.' . $config['layout'])


@section('content')
  <section class="content">
    <div class="container-fluid">
      <form method="post">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Quick Example</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          @csrf
          <div class="card-body bg-dark pl-1 pr-1">
            <div class="d-flex">
              <i class="fas fa-layer-group"></i>
            </div>
            <p class="text-light">{{ $commands }}</p>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection
