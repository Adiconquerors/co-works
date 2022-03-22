<?php $tool_tip = '';
				if(isset($value->tool_tip))
					$tool_tip = $value->tool_tip;
$checked = '';
if($value->value)
$checked = 'checked';
				?>
  <div class="col-md-6">
             <div class="p-20">
						   <fieldset class="form-group m-b-20 si setting-checkbox">
						   {{-- {{ Form::label($key, getPhrase($key)) }} --}}

						  <label data-toggle="tooltip" data-placement="top" title="{{$tool_tip}}">
						  	{{getPhrase($key)}} </label>

						   <input 
					 		type="checkbox" 
							data-toggle="toggle" 
							data-onstyle="success" 
							data-offstyle="default"

					 		name="{{$key}}[value]" 
					 		required="true" 
					 		value = "1" 
							
							title ="{{$tool_tip}}"
							data-placement="bottom"
							{{$checked}}
							class="form-control"
					 		>

					 		

					 		<input
					 		type="hidden"
					 		name="{{$key}}[type]"
							value = "{{$value->type}}" >
				
							<input
					 		type="hidden"
					 		name="{{$key}}[tool_tip]"
							value = "{{$tool_tip}}" >

							</fieldset>
							</div>
						</div>