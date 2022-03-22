@extends('layouts.new_admin_layout')

@section('new_content')
    <h3 class="page-title">@lang('global.payment-gateways.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">



<!-- Tab panes -->
<div class="tab-content">

   <div role="tabpanel" class="tab-pane active" id="details">

         <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.payment-gateways.fields.name')</th>
                            <td field-key='name'>{{ $payment_gateway->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.payment-gateways.fields.description')</th>
                            <td field-key='description'>{{ $payment_gateway->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.payment-gateways.fields.logo')</th>
                            <td field-key='logo'>@if($payment_gateway->logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $payment_gateway->logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $payment_gateway->logo) }}"/></a>@endif</td>
                        </tr>
                    </table>

    </div>




</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.payment_gateways.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


