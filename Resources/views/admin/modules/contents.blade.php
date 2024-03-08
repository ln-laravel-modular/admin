@extends($module_config['layout'] . '::layouts.admin')

@section('content')
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Fixed Header Table</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: calc(100vh - 311px);;">
              <table class="table table-striped table-hover table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th width="14px">#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($paginator ?? [] as $content)
                    <tr>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        </div>
                      </td>
                      <td>{{ $content->cid }}</td>
                      <td><a class="" href="contents/{{ $content->cid }}">{{ $content->title }}</a></td>
                      <td>{{ $content->updated_at }}</td>
                      <td>{{ $content->status }}</td>
                      <td style="padding: 0.5rem 0.75rem;">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                          <button type="button" class="btn btn-secondary">编辑</button>
                          <button type="button" class="btn btn-secondary">Middle</button>
                          <button type="button" class="btn btn-secondary">Right</button>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <div class="card-footer__left float-left">
                <a type="button" class="btn btn-sm btn-secondary" href="/admin/note/contents/insert">新增</a>
                <button type="button" class="btn btn-sm btn-secondary">Middle</button>
                <button type="button" class="btn btn-sm btn-secondary">Right</button>
              </div>
              <div class="card-footer__right float-right">
                <ul class="pagination m-0">
                  <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">»</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card-footer -->
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
