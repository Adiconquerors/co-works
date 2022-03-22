@extends( 'layouts.new_admin_layout' )

@section('header_scripts')
<link href="{{CSS}}checkbox.css" rel="stylesheet" type="text/css">
@endsection

@section('new_content')
    <h3 class="page-title">{{getPhrase('settings')}}</h3>

     <div class="panel panel-default">
        <div class="panel-heading">
            {{ isset($title) ? $title : ''}}
        </div>




            <div class="panel-body packages">
                    <div class="row">
                        @if($record->image)
                         @if ( ! empty( $record->image ) && file_exists(IMAGE_PATH_SETTINGS.$record->image))
                        <img src="{{IMAGE_PATH_SETTINGS.$record->image}}" width="100" height="100">
                        @else
                        <img src="{{DEFAULT_SPACETYPES_PATH}}" width="100" height="100">
                        @endif
                        @endif

                    </div>

                    {!! Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH',
                        'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')) !!}
                        <div class="row">
                        <ul class="list-group">
                        @if(count($settings_data))

                        @foreach($settings_data as $key=>$value)
                        <?php
                            $type_name = 'text';

                            if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
                                $type_name = 'text';
                            else
                                $type_name = $value->type;
                        ?>
                         {{-- {{dd($value)}} --}}
                        @include(
                                    'mastersettings.settings.sub-list-views.'.$type_name.'-type',
                                    array('key'=>$key, 'value'=>$value)
                                )
                          @endforeach

                          @else
                              <li class="list-group-item">{{ getPhrase('no_settings_available')}}</li>
                          @endif
                        </ul>

                        </div>



                        @if(count($settings_data))
                        <br>
                        <div class="form-group pull-right">
                            <button class="btn btn-success" ng-disabled='!formTopics.$valid'
                            >{{ getPhrase('update') }}</button>
                        </div>
                        @endif




                            {!! Form::close() !!}
                    </div>




@endsection


@section('new_admin_js_scripts')

<script type="javascript" src="{{JS}}bootstrap-toggle.min.js"></script>
@stop