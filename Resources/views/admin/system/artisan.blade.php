@extends($config['slug'] . '::layouts.master')


@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Quick Example</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post">
          @csrf
          <div class="card-body">
            <p class="text-light bg-dark">{{ $commands }}</p>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection
