@extends($config['slug'] . '::layouts.master')

@section('content')
  @if (View::exists($moduleConfig['slug'] . '::' . $config['slug'] . '.index'))
    @include($moduleConfig['slug'] . '::' . $config['slug'] . '.index')
  @endif
@endsection
