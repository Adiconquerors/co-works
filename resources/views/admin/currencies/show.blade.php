@inject('request', 'Illuminate\Http\Request')
@extends('layouts.new_admin_layout')

@section( 'new_content' )
    <h3 class="page-title">{{$currency->name . '('.$currency->symbol.')'}}</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <?php
        $tabs = [
            'details_active' => 'active',
        ];
        
        if ( ! empty( $list ) ) {
            foreach ($tabs as $key => $value) {
                $tabs[ $key ] = '';
                if ( substr( $key, 0, -7) == $list ) {
                    $tabs[ $key ] = 'active';
                }
            }
        }
        ?>

        <div class="panel-body table-responsive">

<!-- Tab panes -->
<div class="tab-content">

  <div role="tabpanel" class="tab-pane {{$tabs['details_active']}}" id="details">

        <div class="pull-right">
            
                <a href="{{ route('currencies.edit',[$currency->id]) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil-square-o"></i>@lang('global.app_edit')</a>
            
       </div>   

      <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.currencies.fields.name')</th>
                            <td field-key='name'>{{ $currency->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.currencies.fields.symbol')</th>
                            <td field-key='symbol'>{{ $currency->symbol }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.currencies.fields.code')</th>
                            <td field-key='code'>{{ $currency->code }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.currencies.fields.rate')</th>
                            <td field-key='rate'>{{ $currency->rate }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.currencies.fields.status')</th>
                            <td field-key='status'>{{ $currency->status }}</td>
                        </tr>
                    </table>

    </div> 


</div>

            <p>&nbsp;</p>

            <a href="{{ route('currencies.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

