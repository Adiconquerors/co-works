@extends( 'layouts.new_admin_layout' )

@section('new_content')
<style>
    #sty-mr15{
      margin-right: 15px;
    }
    #sty-mrpl{
        margin-right: 5px;color:#ff0000;padding-left: 20px;
    }
  </style>
   <h3 class="page-title">{{ $master_setting->module }}
        @include('admin.common.drop-down-menu', [
        'links' => [
            [
                'route' => 'admin.master_settings.edit',
                'title' => trans('global.app_edit'),
                'type' => 'edit',
                'icon' => '<i class="fa fa-pencil-square-o" id="sty-mr15"></i>',
                'permission_key' => 'master_setting_edit',
            ],
            [
                'route' => 'admin.master_settings.destroy',
                'title' => trans('global.app_delete'),
                'type' => 'delete',
                'icon' => '<i class="fa fa-trash-o" id="sty-mrpl"></i>',
                'redirect_url' => url()->previous(),
                'permission_key' => 'master_setting_delete',
            ],
        ],
        'record' => $master_setting,
        ] )
    </h3>

    <div class="panel panel-default">

        <div class="panel-heading">
            @lang('global.app_view')
        </div>


        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.master-settings.fields.module')</th>
                            <td field-key='module'>{{ $master_setting->module }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.master-settings.fields.key')</th>
                            <td field-key='key'>{{ $master_setting->key }}</td>
                        </tr>
                        <tr>
                            <th>@lang('custom.settings.moduletype')</th>
                            <td field-key='moduletype'>{{ $master_setting->moduletype }}</td>
                        </tr>
                        <tr>
                            <th>@lang('custom.settings.status')</th>
                            <td field-key='status'>{{ $master_setting->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.master-settings.fields.description')</th>
                            <td field-key='description'>{!! clean($master_setting->description) !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.master_settings.index') }}" class="btn btn-default">@lang('custom.translationmanager.back')</a>
        </div>
    </div>
@stop


