@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section('new_content')
<style>
    .sty-alcen{
        text-align: center;
    }
</style>
     @include('admin.common.breadcrumbs', compact('route','active_class','title') )

    <div class="panel panel-default">
       
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($internal_notifications) > 0 ? 'datatable' : '' }} @can('internal_notification_delete') dt-select @endcan">
                <thead>
                    <tr>
                        
                        <th>@lang('global.internal-notifications.fields.text')</th>
                        <th>@lang('global.internal-notifications.fields.link')</th>
                        <th>@lang('global.internal-notifications.fields.users')</th>
                       <th>@lang('global.app_actions')</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($internal_notifications) > 0)
                        @foreach ($internal_notifications as $internal_notification)
                            <tr data-entry-id="{{ $internal_notification->id }}">
                                @can('internal_notification_delete')
                                    <td></td>
                                @endcan

                                <td field-key='text'>{{ $internal_notification->text }}</td>
                                <td field-key='link'><a href="{{$internal_notification->link}}" target="_blank">{{ $internal_notification->link }}</td>
                                <td field-key='users'>
                                    @foreach ($internal_notification->users as $singleUsers)
                                        <span class="label label-info label-many">{{ $singleUsers->name }}</span>
                                    @endforeach
                                </td>
                                                                <td>
                                    
                                    <a href="{{ route('internal_notifications.show',[$internal_notification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                   
                                    <a href="{{ route('internal_notifications.edit',[$internal_notification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                  
                                    
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['internal_notifications.destroy', $internal_notification->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="sty-alcen" colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('internal_notification_delete')
            window.route_mass_crud_entries_destroy = '{{ route('internal_notifications.mass_destroy') }}';
        @endcan

    </script>
@endsection