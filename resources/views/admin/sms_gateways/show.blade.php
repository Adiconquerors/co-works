@extends('layouts.new_admin_layout')

@section('new_content')
    <h3 class="page-title">@lang('global.sms-gateways.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.sms-gateways.fields.name')</th>
                            <td field-key='name'>{{ $sms_gateway->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.sms-gateways.fields.key')</th>
                            <td field-key='key'>{{ $sms_gateway->key }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.sms-gateways.fields.description')</th>
                            <td field-key='description'>{!! clean($sms_gateway->description) !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.sms_gateways.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


