@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section('new_content')
    <h3 class="page-title">@lang('global.roles.title')</h3>
  
    <p>
        <a href="{{ route('roles.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;@lang('global.app_add_new')</a>
        
    </p>
   
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
             @include('admin.roles.records-display')
        </div>
    </div>
@stop

@section( 'new_admin_js_scripts' ) 
    @include('admin.roles.records-display-scripts')
@endsection