@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section('new_content')
<style>
.sty-tc{
    text-align: center;
}
</style>
    <h3 class="page-title">@lang('global.payment-gateways.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('payment_gateway_delete_multi') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('payment_gateway_delete_multi')
                            @if ( request('show_deleted') != 1 )<th class="sty-tc"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.payment-gateways.fields.name')</th>
                        <th>@lang('global.payment-gateways.fields.description')</th>
                        <th>@lang('global.payment-gateways.fields.logo')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('new_admin_js_scripts')
    <script>
        @can('payment_gateway_delete_multi')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.payment_gateways.mass_destroy') }}'; @endif
        @endcan
        $(document).ready(function () {
            "use strict";

            window.dtDefaultOptions.buttons = [];
            window.dtDefaultOptions.ajax = '{!! route('admin.payment_gateways.index') !!}?show_deleted={{ request('show_deleted') }}';
            window.dtDefaultOptions.columns = [@can('payment_gateway_delete_multi')
                @if ( request('show_deleted') != 1 )
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endif
                @endcan{data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'logo', name: 'logo'},

                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection