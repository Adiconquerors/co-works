<div class="row">
   <div class="col-md-6">
      <div class="p-20">

          <div class="form-group m-b-20">
            <label for="customer_id">@lang('custom.leads.customers')</label>

             {{ Form::select('customer_id', $customers ,old('customer_id'), ['class'=>'form-control', 'placeholder'=>trans('custom.eforms.please-select'),

                  'id'=>'lead_customer_id', 'required'=>'true'

                  ]) }}
         </div>



       <div class="form-group m-b-20">

        {!! Form::label('email',trans('custom.eforms.email') ) !!}

        {!! Form::email('email', old('email'), ['class' => 'form-control',
        'id'=>'lead-email','placeholder'=>trans('custom.eforms.email'),'required'=>'true'

        ]) !!}


      </div>

       <div class="form-group m-b-20">

        {!! Form::label('phone_number',trans('custom.eforms.phone-num') ) !!}

        {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control',
          'id'=>'lead-phone-number','placeholder'=>trans('custom.eforms.phone-num'),
          'required'=>'true'
        ]) !!}

      </div>


      <div class="form-group m-b-20">
        {!! Form::label('address',trans('custom.eforms.address') ) !!}

         <input id="address" type="text" class="form-control" id="address" name="address" placeholder="@lang('custom.eforms.address')" value="{{$record->address ?? ''}}" onfocus="initialize_autocomplete('address')">

      </div>

       <div class="form-group m-b-20">
        {!! Form::label('company',trans('custom.eforms.company') ) !!}

        {!! Form::text('company', old('company'), ['class' => 'form-control',
        'id'=>'lead-company','placeholder'=>trans('custom.eforms.company')

        ]) !!}

      </div>


  <div class="form-group m-b-20">
            <?php

              $enquire_from = array(
                 trans('custom.eforms.bbn') => trans('custom.eforms.bbn'),
                 trans('custom.eforms.md') =>  trans('custom.eforms.md'),
                 trans('custom.eforms.me') =>  trans('custom.eforms.me')
              );

            ?>

          <label for="enquire_from">@lang('custom.leads.inquiry-from')</label>

            {{ Form::select('enquire_from', $enquire_from ,old('enquire_from'), ['class'=>'form-control', 'placeholder'=>trans('custom.eforms.please-select'),

            'id'=>'lead_enquire_from'

            ]) }}

         </div>

      </div>
      <!-- end class p-20 -->
   </div>
   <!-- end col -->
   <div class="col-md-6">
      <div class="p-20">



        <div class="form-group m-b-20">
            <?php

              $capicities = array(
              '1 - 50' => trans('custom.eforms.one-fifty'),
              '51 - 100' => trans('custom.eforms.fifty-one'),
              '101 - 200' =>  trans('custom.eforms.hundred-one'),
              '201 - 300' => trans('custom.eforms.twohundred-one'),
              '301 - 400' => trans('custom.eforms.threehundred-one'),
              '401 - 500' =>  trans('custom.eforms.fourhundred-one'),
              '500+' => trans('custom.eforms.fivehundred-one'),
              );

            ?>

            <label for="capacity_id">@lang('custom.eforms.capacity')</label>

            {{ Form::select('capacity_id', $capicities ,old('capacity_id'), ['class'=>'form-control', 'placeholder'=>trans('custom.eforms.please-select'),

            'id'=>'lead_capacity_id'

            ]) }}

         </div>

         <div class="form-group m-b-20">

              {!! Form::label('description',trans('custom.eforms.description'),['class' => 'mb-3']) !!}

            <div class="row">
               <div class="col-12">

                   {!! Form::textarea('description', old('description'), ['class' => 'form-control' ,  'id'=>'lead-description', 'rows'=>'5', 'placeholder' => trans('custom.eforms.description')]) !!}
               </div>
            </div>
            <!-- end row -->
         </div>

          <div class="form-group m-b-20">
            <label for="property_id">@lang('custom.leads.property')</label>

            {{ Form::select('property_id', $properties ,old('property_id'), ['class'=>'form-control', 'placeholder'=>trans('custom.eforms.please-select'),

            'id'=>'lead_property_id', 'required'=>'true'

            ]) }}

         </div>


        <div class="form-group m-b-20">
           <label for="enquire_date">@lang('custom.leads.inquiry-date')</label>
          <div class="control-group">
            <div class="controls">
                <input type="date" name="enquire_date" value="{{ old('enquire_date') }}" class="input-large form-control" />
            </div>
            </div>

      </div>

          <div class="form-group m-b-20">
            {!! Form::label('enquire_month',trans('custom.eforms.enq-month') ) !!}

            {!! Form::text('enquire_month', old('enquire_month'), ['class' => 'form-control',
            'id'=>'lead-enquire-month','placeholder'=>trans('custom.eforms.enq-month')

            ]) !!}

          </div>

      </div>
      <!-- end class p-20 -->
   </div>
   <!-- end col -->
</div>
<!-- end row -->
<div class="text-center">
   <button type="submit" class="btn btn-success waves-effect waves-light">{{ $button_name }}</button>
</div>

