@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section('new_content')

   @include('admin.common.breadcrumbs', compact('route','active_class','title') )


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable  ">
                <thead>
                    <tr>

                        <th>@lang('global.languages.fields.language')</th>
                        <th>@lang('global.languages.fields.code')</th>
                        <th>@lang('global.languages.fields.is-rtl')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>@lang('custom.app_actions')</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('new_admin_js_scripts')
    <script>

        $(document).ready(function () {
            "use strict";

            window.dtDefaultOptions.ajax = '{!! route('admin.languages.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [

                {data: 'language', name: 'language'},
                {data: 'code', name: 'code'},
                {data: 'is_rtl', name: 'is_rtl'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection