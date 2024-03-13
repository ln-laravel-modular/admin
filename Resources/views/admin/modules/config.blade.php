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
          @php
            // ['target', 'make-prepend', 'make-append', 'title', 'description', 'files'];
            $makes = [
                ['command', null, null, null, 'Artisan 命令'],
                ['component', null, null, null, '组件'],
                ['component-view'],
                ['controller'],
                ['event'],
                ['factory', null, null, 'Factories', '模型工厂', $moduleConfig['factories']],
                ['job', null, null, null, '队列任务'],
                ['listener'],
                ['mail', null, null, null, '可邮寄类'],
                ['middleware'],
                ['migration', 'create_', '_table', 'Migration', '数据库迁移', $moduleConfig['migrations']],
                ['model', $moduleConfig['name'], null, 'Entities', '模型实体', $moduleConfig['entities']],
                ['notification', null, null, null, '消息通知'],
                ['policy'],
                ['provider'],
                ['request'],
                ['resource'],
                ['rule'],
                ['seed', $moduleConfig['name'], 'Seeder', 'Seeder', '数据填充', $moduleConfig['seeders']],
                ['test'],
            ];
          @endphp
          {{-- @each('admin::components.config.module-make', [['target' => 'make-model']], 'attributes') --}}
          @foreach ($makes as $make)
            <x-admin::config.module-make :props="$make"></x-admin::config.module-make>
          @endforeach
          {{-- <x-admin::config.module-make :attributes="['title' => 'Entities']"></x-admin::config.module-make>
          <x-admin::config.module-make target="make-model" title='Entities' description="模型实体" :files="$moduleConfig['entities']">
          </x-admin::config.module-make>
          <x-admin::config.module-make target="make-model" title='Factories' description="模型工厂"
            :files="$moduleConfig['factories']"></x-admin::config.module-make> --}}
          {{-- @include($config['slug'] . '::admin.modules.config.make-model') --}}
          {{-- @include($config['slug'] . '::admin.modules.config.make-factory') --}}

        @section('migrations')
          <div class="card card-default d-none">
            <div class="card-header">
              <h3 class="card-title">Migration <small>数据库迁移</small></h3>
              <form class="card-tools mb-0">
                <div class="input-group input-group-sm" style="width: 280px;">
                  <div class="input-group-prepend">
                    <span class="input-group-text">create_</span>
                  </div>
                  <input type="text" name="make-migration" class="form-control float-right"
                    placeholder="Make Migration">
                  <div class="input-group-append">
                    <span class="input-group-text">_table</span>
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
              @foreach ($moduleConfig['migrations'] ?? [] as $file)
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

        @section('seeders')
          <div class="card card-default d-none">
            <div class="card-header">

              <h3 class="card-title">Seeder <small>数据填充</small></h3>
              <div class="card-tools">
                <form action="" class="mb-0">

                  <div class="input-group input-group-sm" style="width: 280px;">
                    <div class="input-group-prepend">
                      <span class="input-group-text">{{ $moduleConfig['name'] }}</span>
                      <input type="hidden" class="form-control" name='seeder-prepend'
                        value="{{ $moduleConfig['name'] }}">
                    </div>
                    <input type="text" name="make-seeder" class="form-control float-right"
                      placeholder="Make Seeder">

                    <div class="input-group-append">
                      <span class="input-group-text">Seeder</span>
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
