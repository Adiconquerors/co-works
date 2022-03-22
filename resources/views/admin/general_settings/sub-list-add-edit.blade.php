@extends( 'layouts.new_admin_layout' )



@section('new_content')
<style>
    .sty_db{
        display:block;
    }
</style>
    <h3 class="page-title">@lang('custom.settings.settings')</h3>

     <div class="panel panel-default">
        <div class="panel-heading">
            {{ isset($title) ? $title : ''}}
        </div>

        {{--@include('errors.errors')--}}

        <div class="row" ng-controller="angTopicsController">

          <div class="col-md-6">
             <div class="p-20">

              <div class="form-group m-b-20">  
            <?php $field_types = array(
                            '' => 'Select Type',
                            'text' => 'Text',
                            'number' => 'Number',
                            'email' => 'Email',
                            'password' => 'Password',
                            'select' => 'Select',
                            'checkbox' => 'Checkbox',
                            'file' => 'Image(.png/.jpeg/.jpg)',
                            'textarea' => 'Textarea',
                            ); ?>

            {!! Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'POST', 
                        'name'=>'formSettings ', 'files'=>'true')) !!}

               </div>         
                                      
        		
                <div class="form-group m-b-20">

                        {{ Form::label('key', trans('custom.settings.key')) }}
                        <span class="text-red">*</span>
                        {{ Form::text('key', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => trans('custom.settings.key'),
                    
                         ))}}

                     
                </div>


                 <div class="form-group m-b-20">

                       {{ Form::label('tool_tip', trans('custom.settings.tool-tip')) }}
                        <span class="text-red">*</span>
                        {{ Form::text('tool_tip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => trans('custom.settings.tool-tip'),
                    
                         ))}}

                     </div>



                    <div class="form-group m-b-20">
                        {{ Form::label('type', trans('custom.settings.type')) }}

                        <span class="text-red">*</span>
                        {{Form::select('type',$field_types, null, ['class'=>'form-control', 
                        'ng-model' => 'field_type' ])}}

                     </div>

                    
                    <div class="form-group m-b-20" ng-if="field_type=='text' || field_type=='password' || field_type=='number' || field_type=='email'||  field_type=='file' ">
                        {{ Form::label('type', trans('custom.settings.value')) }}
                        
                         <input 
                            type="@{{field_type}}" 
                            class="form-control" 
                            name="value" 
                            ng-model='value'>
                     </div>
                   

                    </div>
                  <!-- end class p-20 -->
               </div>
               <!-- end col -->

                <div class="col-md-6">
                  <div class="p-20">

                    
                     <div class="form-group m-b-20" ng-if="field_type=='checkbox' ">
                        {{ Form::label('type', trans('custom.settings.value')) }}
                        
                         <input 
                            type="checkbox" 
                            

                            class="form-control sty_db" 
                            name="value" 
                            value="1" 
                            required="true" 
                            
                            
                            checked>
                     </div>

                  


                      <div class="form-group m-b-20" ng-if="field_type=='select'">

                        {{ Form::label('total_options', trans('custom.settings.total-options')) }}
                        
                        <input 
                            type="number" 
                            class="form-control" 
                            name="total_options" 
                            min="1"
                            required="true" 
                            ng-model='obj.total_options'
                            ng-change="intilizeOptions(obj.total_options)"
                     >
                     </div>



                     <div class="form-group m-b-20" ng-if="field_type=='textarea'">

                        {{ Form::label('description', getphrase('description')) }}
                        
                       <textarea name="value" class="form-control ckeditor" ng-model='value' rows="5" ></textarea>

                     </div>



                     <div class="form-group m-b-20" data-ng-repeat="option in options">
                        <div class="col-md-12">
                        
                    <div class="form-group m-b-20 col-md-4" >
                        {{ Form::label('option_value', trans('custom.settings.value') ) }} @{{option}}
                            <input 
                            type="text" 
                            class="form-control" 
                            name="option_value[]" 
                            required="true" >
                    </div>

                    <div class="form-group m-b-20 col-md-4" >
                        {{ Form::label('option_text', trans('custom.settings.option-text') ) }} @{{option}}
                            <input 
                            type="text" 
                            class="form-control" 
                            name="option_text[]" 
                            required="true" >
                    </div>

                    <div class="form-group m-b-20 col-md-4" >
                    
                            <input type="radio" name="value" value="@{{option-1}}" id="radio@{{option}}" >
                            <label for="radio@{{option}}"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> {{getPhrase('make_default')}} </label>
                    
                    </div>

                        </div>

                     </div>

                   </div>
                 </div>



                </div>

			</div>


    	</div>

</div>
           <div class="form-group pull-right">
              <br>
                <button class="btn btn-success">{{ trans('custom.settings.save') }}</button>

            </div>


            {!! Form::close() !!}



@endsection

@section('new_admin_js_scripts')

@include('admin.general_settings.scripts.js-scripts' );
@include('admin.common.validations', array('isLoaded'=>true));

<script type="javascript" src="{{JS}}bootstrap-toggle.min.js"></script>

@stop    