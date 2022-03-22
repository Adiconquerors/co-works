@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section('new_content')
<style>
    .sty_tac{
        text-align:center;
    }
</style>
    <h3 class="page-title">@lang('global.permissions.title')</h3>
    @can('permission_create')
    <p>
        <a href="{{ route('permissions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan



    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('permission_delete_multi') dt-select @endcan">
                <thead>
                    <tr>
                        @can('permission_delete_multi')
                            <th class="sty_tac"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.permissions.fields.title')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

    @section( 'new_admin_js_scripts' )
    <script>
        @can('permission_delete_multi')
            window.route_mass_crud_entries_destroy = '{{ route('permissions.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            "use strict";

            window.dtDefaultOptions.ajax = '{!! route('permissions.index') !!}';
            window.dtDefaultOptions.columns = [@can('permission_delete_multi')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'title', name: 'title'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection