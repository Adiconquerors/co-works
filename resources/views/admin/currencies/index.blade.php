@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section( 'new_content' )
<style>
    .p_10{
        padding: 10px;
        }
</style>
    
      @include('admin.common.breadcrumbs', compact('route','active_class','title') )


    <div class="panel panel-default">
        <p class="p_10">@lang('custom.currencies.currency_layer_message', ['url' => '<a href="https://currencylayer.com" target="_blank">https://currencylayer.com</a>', 'settings_url' => '<a href="'.url('admin/mastersettings/settings/view/currency-settings').'" target="_blank">here</a>'])

        <a href="{{route('currency.update_rates')}}" class="btn btn-xs btn-success">@lang('global.update_currency_rates')</a>
        
        </p>
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
          @include('admin.currencies.display-records')
        </div>
    </div>
@stop

@section( 'new_admin_js_scripts' ) 
 @include('admin.currencies.display-records-scripts')
@endsection