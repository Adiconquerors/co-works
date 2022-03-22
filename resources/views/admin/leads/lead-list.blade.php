 <style>
 .table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
 }
</style>
 <div class="card-box table-responsive">
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
            <thead>
            <tr>
                <th>@lang('custom.eforms.company')</th>
                <th>@lang('custom.listings.fields.contact-details')</th>
                <th>@lang('custom.inquiries.no-of-seats')</th>
                @if( isAdmin() || isAgent())
                <th>@lang('custom.eforms.deal-status')</th>
                @endif
                <th>@lang('global.app_actions')</th>
            </tr>
            </thead>


            <tbody>
              @foreach( $items as $item ) 
                 
                <?php
                    $sub_space_types =  \App\SpaceType::find( $item->sub_space_type_id);
                    $cities =  \App\City::find( $item->city_id);
                    $properties =  \App\Property::find( $item->property_id);
                ?>
                

            <tr>
             
                <td>
                    {{ $item->company ?? '-' }}
                </td>
                <td>
                    @lang('custom.eforms.name')   : {{ $item->name ?? '-' }}<br/>
                    @lang('custom.eforms.email')  : {{ $item->email ?? '-' }}<br/>
                    @lang('custom.eforms.mobile') : {{ $item->phone_number ?? '-' }}<br/>
                </td>
                <td>{{ $item->capacity_id ?? '-' }}</td>
                @if( isAdmin() || isAgent()) 
                <td>
                     {{ $item->deal_status ?? '-'}}   
                </td>
                @endif

                <td class="actions">
                    <a href="{{ route('leads.show',$item->id) }}" class="hidden on-editing save-row"><i class="far fa-eye"></i></a>

          
                    {!!Form::close()!!} 

                    
                    </td>

            </tr>
                 @endforeach   

            </tbody>
        </table>

         @include('admin.common.delete-script',['users.destroy'] ) 

    </div>