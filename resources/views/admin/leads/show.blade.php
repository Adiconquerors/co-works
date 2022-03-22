@extends( 'layouts.new_admin_layout' )

@section( 'new_content' )
<div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <h4 class="page-title">  @lang('custom.leads.lead-details')</h4>
         <ol class="breadcrumb p-0 m-0">
            <li class="breadcrumb-item">
               <a href="{{ route('leads.index') }}">{{ ucwords( $active_class ) }}</a>
            </li>
            <li class="breadcrumb-item">
               {{ $title }}
            </li>
         </ol>
         <div class="clearfix"></div>  
      </div>
   </div>
</div>
<!-- end row -->
@php
            $cities =  \App\City::find( $record->city_id);
            $properties =  \App\Property::find( $record->property_id);

            $property_sub_space_types = $properties->property_sub_space_types;
         @endphp
<div class="card led-view">
 
 
      <ul class="list-group list-group-flush">
 
<li class="list-group-item">@lang('custom.users.name') <span> {{ $record->name ?? '-' }} </span> </li>
<li class="list-group-item">@lang('custom.users.email') <span> {{ $record->email ?? '-'}} </span></li>
<li class="list-group-item">@lang('custom.users.phone')<span>{{ $record->phone_number ?? '-' }} </span> </li>
<li class="list-group-item">@lang('custom.leads.address') <span>{{ $record->address ?? '-'}} </span> </li>
<li class="list-group-item">@lang('custom.leads.company') <span>{{ $record->company ?? '-'}} </span></li>
<li class="list-group-item">@lang('custom.spacetypes.space-types') <span>   @foreach($property_sub_space_types as $property_type)
   <?php 
      $spacetypes = \App\SpaceType::find($property_type->space_type_id);
    ?> 
      {{$spacetypes ? $spacetypes->name : ''}}<br/>    
 @endforeach </span> </li>
<li class="list-group-item"> @lang('custom.leads.capacity') <span>{{ $record->capacity_id ?? '-'}} </span> </li>
<li class="list-group-item"> @lang('custom.leads.description') <span>{{ $record->description ?? '-'}} </span></li>
@if( $record->enquire_date == 'undefined' )
    <?php
      $enquire_date = '-';
    ?>
  <li class="list-group-item">@lang('custom.leads.inquiry-date')<span>{{ $record->enquire_date ? $record->enquire_date : $enquire_date}} </span> </li>
  @else
<li class="list-group-item">@lang('custom.leads.inquiry-date')<span>{{ $record->enquire_date ?? '-'}} </span> </li>  
@endif 
<li class="list-group-item"> @lang('custom.leads.property')<span> {{ $properties ? $properties->name : '-' }} </span></li>
<li class="list-group-item">@lang('custom.leads.inquiry-from')<span>{{ $record->enquire_from ?? '-'}} </span> </li>

               
               <li class="list-group-item">
               <?php
               $assigned_to_users = \App\User::find($record->assigned_to);
               ?>
               @lang('custom.inquiries.assigned-to') <span> @if( $record->assigned_to == 0 )
                    <?php
                    $not_assigned = trans('custom.inquiries.not-assigned');
                    ?>
                    {{$not_assigned}}
                  @else
                    {{ $assigned_to_users ? $assigned_to_users->name : $not_assigned }}
                  @endif </span> 
            
            </li>


            @if( isAdmin() || isAgent() )

@if( ! empty( $record->deal_lost ) )
<li class="list-group-item"> @lang('custom.leads.deal-lost-reason') <span>{{ $record->deal_lost ?? '-'}} </span> </li>
@endif
@if( ! empty( $record->deal_comments ) )
<li class="list-group-item">@lang('custom.leads.deal-lost-comments')<span>{{ $record->deal_comments ?? '-'}} </span> </li>
@endif
<li class="list-group-item">@lang('custom.eforms.deal-lost')<span>{{ $record->deal_lost_no ?? '-' }} </span> </li>
<li class="list-group-item">@lang('custom.inquiries.junk-lead')<span>{{ $record->junk_lead ?? '-' }} </span> </li>
@endif
</ul>
 
</div>

@endsection