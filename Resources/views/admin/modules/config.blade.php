@extends($config['slug'] . '::layouts.master')


@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        @empty($alert)
        @else
          <div class="col-md-12">
            <div class="alert alert-{{ $alert['type'] }}" role="alert">
              {{ $alert['message'] }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>

            </div>
          </div>
        @endempty


        <div class="col-md-6">
          <form method="POST">
            @csrf
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Basic <small class="text-muted">基础</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">
                <div class="form-group d-none">
                  <label>Config Target</label>
                  <input type="text" class="form-control" name='_target' value="basic">
                </div>
                <div class="form-group">
                  <label>Name <small class="text-muted">模块名称</small></label>
                  <input type="text" class="form-control" name='title' value="{{ $moduleConfig['name'] ?? '' }}"
                    disabled>
                </div>
                <div class="form-group">
                  <label>Slug <small class="text-muted">模块别名</small></label>
                  <input type="text" class="form-control" name='slug' value="{{ $moduleConfig['slug'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Title <small class="text-muted">模块标题</small></label>
                  <input type="text" class="form-control" name='title' value="{{ $moduleConfig['title'] ?? '' }}">
                </div>
                <div class="form-group">
                  <label>Type <small class="text-muted">模块类型: project, theme, extra, other</small></label>
                  <input type="text" class="form-control" name='type'
                    value="{{ $moduleConfig['type'] ?? 'project' }}">
                </div>
                <div class="form-group">
                  <label>Description <small class="text-muted">模块说明</small></label>
                  <textarea class="form-control" name='description' rows="3">{{ $moduleConfig['description'] ?? '' }}</textarea>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
              </div>
            </div>
          </form>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">View <small class="text-muted">视图</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label>UI <small class="text-muted">模块界面框架</small></label>
                <input type="text" class="form-control" name='ui'
                  value="{{ $moduleConfig['ui'] ?? 'bootstrap' }}">
              </div>
              <div class="form-group">
                <label>Component <small class="text-muted">模块组件</small></label>
                <input type="text" class="form-control" name='component'
                  value="{{ $moduleConfig['component'] ?? '' }}">
              </div>
              <div class="form-group">
                <label>Layout <small class="text-muted">模块布局</small></label>
                <input type="text" class="form-control" name='layout' value="{{ $moduleConfig['layout'] ?? '' }}">
              </div>
              <div class="form-group">
                <label>Theme <small class="text-muted">模块主题</small></label>
                <input type="text" class="form-control" name='theme'
                  value="{{ $moduleConfig['theme'] ?? 'default' }}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Route <small class="text-muted">路由</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label>Prefix <small class="text-muted">模块前缀</small></label>
                <input type="text" class="form-control" name='prefix' value="{{ $moduleConfig['prefix'] ?? '' }}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>

          <div class="card card-default d-none">
            <div class="card-header">
              <h3 class="card-title">Layout <small class="text-muted">布局</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Other <small class="text-muted">其它</small></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label>Key <small class="text-muted">模块...</small></label>
                <input type="text" class="form-control" name='key' value="{{ $moduleConfig['key'] ?? '' }}">
              </div>
              <div class="form-group">
                <label>MD5 <small class="text-muted">模块...</small></label>
                <input type="text" class="form-control" name='md5' value="{{ $moduleConfig['md5'] ?? '' }}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </div>
        </div>
        <div class="col-md-6">
        @section('entities')
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Entities <small>模型实体</small></h3>
              <form method="POST" class="card-tools mb-0">
                @csrf
                <div class="form-group d-none">
                  <label>Config Target</label>
                  <input type="text" class="form-control" name='_target' value="make-model">
                </div>
                <div class="input-group input-group-sm">
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
        @show

        @section('factories')
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Factories <small>模型工厂</small></h3>
              <form method="POST" class="card-tools mb-0">
                @csrf
                <div class="form-group d-none">
                  <label>Config Target</label>
                  <input type="text" class="form-control" name='_target' value="make-factory">
                </div>
                <div class="input-group input-group-sm">
                  <input type="text" name="factory" class="form-control float-right" placeholder="Make Factory">
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
              @foreach ($moduleConfig['factories'] ?? [] as $factory)
                <li class="list-group-item">
                  <div class="form-group mb-0">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" disabled>
                      <label for="checkboxPrimary2">
                        {{ $factory }}
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
        @show
        @section('migrations')
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Migration <small>数据库迁移</small></h3>
              <form class="card-tools mb-0">
                <div class="input-group input-group-sm">
                  <input type="text" name="make_migration" class="form-control float-right"
                    placeholder="Make Migration">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body d-none">

            </div>
            <!-- /.card-body -->
            <ul class="list-group list-group-flush">
              @foreach ($moduleConfig['migrations'] ?? [] as $migration)
                <li class="list-group-item">
                  <div class="form-group mb-0">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" disabled>
                      <label for="checkboxPrimary2">
                        {{ $migration }}
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
        @show

        @section('seeders')
          <div class="card card-default">
            <div class="card-header">

              <h3 class="card-title">Seeder <small>数据填充</small></h3>
              <div class="card-tools">
                <form action="" class="mb-0">

                  <div class="input-group input-group-sm">
                    <input type="text" name="make_seeder" class="form-control float-right"
                      placeholder="Make Seeder">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body d-none">
            </div>
            <!-- /.card-body -->
            <ul class="list-group list-group-flush">
              @foreach ($moduleConfig['seeders'] ?? [] as $file)
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
        @show
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Dropzone.js <small><em>jQuery File Upload</em> like look</small></h3>
          </div>
          <div class="card-body">
            <div id="actions" class="row">
              <div class="col-lg-12">
                <div class="btn-group w-100">
                  <span class="btn btn-success col fileinput-button dz-clickable">
                    <i class="fas fa-plus"></i>
                    <span>Add files</span>
                  </span>
                  <button type="submit" class="btn btn-primary col start">
                    <i class="fas fa-upload"></i>
                    <span>Start upload</span>
                  </button>
                  <button type="reset" class="btn btn-warning col cancel">
                    <i class="fas fa-times-circle"></i>
                    <span>Cancel upload</span>
                  </button>
                </div>
              </div>
              <div class="col-lg-12 d-flex align-items-center mt-1">
                <div class="fileupload-process w-100">
                  <div id="total-progress" class="progress progress-striped active" role="progressbar"
                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="table table-striped files" id="previews">

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and
            information about the plugin.
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection
