@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section('new_content')


    @include('admin.common.breadcrumbs', compact('route','active_class','title') )
  
    <div class="panel panel-default">
       
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($menus) > 0 ? 'datatable' : '' }} @can('menu_delete') dt-select @endcan">
                <thead>
                    <tr>
                        
                        <th>@lang('custom.eforms.text')</th>
                        <th>@lang('custom.eforms.link')</th>
                        <th>@lang('custom.settings.type')</th>
                        <th>@lang('custom.icons.icon-name')</th>
                        <th>@lang('global.app_actions')</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($menus) > 0)
                        @foreach ($menus as $menu)
                            <tr data-entry-id="{{ $menu->id }}">
                                @can('internal_notification_delete')
                                    <td></td>
                                @endcan

                                <td field-key='text'>{{ $menu->text }}</td>
                                <td field-key='link'><a href="{{$menu->link}}" target="_blank">{{ $menu->link }}</td>
                                 <td field-key='type'>{{ $menu->type }}</td>
                                 <td field-key='icon'>{{ $menu->icon->name }}</td>
                                <td>
                                    
                                    <a href="{{ route('menus.show',[$menu->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                   
                                    <a href="{{ route('menus.edit',[$menu->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                  
                                    
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['menus.destroy', $menu->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('new_admin_js_scripts') 
    <script>
        @can('menu_delete')
            window.route_mass_crud_entries_destroy = '{{ route('menus.mass_destroy') }}';
        @endcan

    </script>
@endsection