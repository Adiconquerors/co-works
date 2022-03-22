@extends('layouts.new_admin_layout')

@section('new_admin_head_links')
<link href="{{CSS}}checkbox.css" rel="stylesheet" type="text/css">
@endsection

@section('new_content')
<style>
  .tcbm{
    margin-top:25px; 
  }
</style>
    <div class="row">
     <div class="col-12">
        <div class="page-title-box">
           <h4 class="page-title">{{trans('custom.settings.settings')}}</h4>
           <ol class="breadcrumb p-0 m-0">
              <li class="breadcrumb-item">
                 <a href="{{ route('admin.master_settings.index') }}">{{ ucwords($active_class) }}</a>
              </li>
             
              <li class="breadcrumb-item">
                 {{ isset($title) ? $title : ''}}
              </li>
           </ol>
           <div class="clearfix"></div>
        </div>
     </div>
  </div>

  <div class="row">
     <div class="col-md-12">
        <div class="card-box">
           
    @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
          </ul>
      </div>
    @endif
          <!-- spacetypes form start -->
     <?php $button_name = trans('app_create'); ?>

        {!! Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH',
                        'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')) !!}

          <div class="row">


              @forelse($settings_data as $key=>$value)
                <?php
                
                $type_name = 'text';
                if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
                    $type_name = 'text';
                else
                    $type_name = $value->type;
                ?>
                @if( $key == 'system_timezone')
                  <div class="col-md-6">
                    <label for="system_timezone">system_timezone</label>
                      <?php
                      $OptionsArray = timezone_identifiers_list();
                      $selected = getSetting('system_timezone', 'site_settings', 'Asia/Kolkata');
                      ?>
                      <select name="system_timezone[value]" class="form-control" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="system_timezone">
                        @foreach( $OptionsArray as $time_zone)
                        <option value="{{$time_zone}}" @if( $time_zone == $selected ) selected="selected" @endif>{{$time_zone}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="system_timezone[type]" value="select">
                    <input type="hidden" name="system_timezone[tool_tip]" value="System time zone">
                  </div>
                @elseif( 'default_payment_gateway' === $key )
                  <div class="col-md-6">
                    <label for="default_payment_gateway">@lang('custom.settings.default-payment-gateway')</label>
                      <?php
                       $payment_gateways = \App\Settings::where('moduletype', 'payment')->get();

                       $selected = getSetting('default_payment_gateway', 'site_settings', 'offline');
                       ?>
                      <select name="default_payment_gateway[value]" class="form-control" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="default_payment_gateway">
                        @foreach( $payment_gateways as $gateway)
                        <option value="{{$gateway->key}}" @if( $gateway->key == $selected ) selected="selected" @endif>{{$gateway->module}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="default_payment_gateway[type]" value="select">
                    <input type="hidden" name="default_payment_gateway[tool_tip]" value="@lang('custom.settings.default-payment-gateway')">
                  </div>
                @elseif( 'default_sms_gateway' === $key )
                  <div class="col-md-6">
                    <label for="default_sms_gateway">@lang('custom.settings.default-sms-gateway')</label>
                      <?php
                       $sms_gateways = \App\Settings::where('moduletype', 'sms')->get();
                       $selected = getSetting('default_sms_gateway', 'site_settings', '');
                       ?>
                      <select name="default_sms_gateway[value]" class="form-control" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="default_sms_gateway">
                        @foreach( $sms_gateways as $gateway)
                        <option value="{{$gateway->key}}" @if( $gateway->key == $selected ) selected="selected" @endif>{{$gateway->module}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="default_sms_gateway[type]" value="select">
                    <input type="hidden" name="default_sms_gateway[tool_tip]" value="@lang('custom.settings.default-sms-gateway')">
                  </div>
                @else
                  @include(
                            'admin.general_settings.sub-list-views.'.$type_name.'-type',
                            array('key'=>$key, 'value'=>$value)
                        )
                @endif
              @empty
                <p>{{ trans('custom.settings.no_records_found') }}</p>
              @endforelse


          </div>

           <div class="text-center tcbm">
             <button type="submit" class="btn btn-success waves-effect waves-light">@lang('global.update')</button>
           </div>

           {!! Form::close() !!}
           <!-- end form -->
              <!-- space_types form close  -->
        </div>
        <!-- end card-box -->
     </div>
     <!-- end col -->
  </div>
  <!-- end row -->

@endsection


@section('new_admin_js_scripts')

<script src="{{JS}}bootstrap-toggle.min.js"></script>
@stop