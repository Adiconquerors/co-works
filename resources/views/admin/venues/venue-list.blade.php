<style>
.table-collapse{
  border-collapse: collapse; border-spacing: 0; width: 100%;
}.dtr-title{
  padding-right:10px;
}
 .maintainht { 
            width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
</style>
 <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                        <thead>
                        <tr>
                            <th>@lang('custom.eforms.property-name')</th>
                            <th>@lang('custom.eforms.property-address')</th>
                            <th>@lang('custom.venues.manager-name')</th>
                            <th>@lang('custom.venues.manager-email')</th>
                            <th> @lang('custom.venues.manager-phone')</th>
                        </tr>
                        </thead>


                        <tbody>
                          @foreach( $items as $item ) 
                             
                        <tr>
                         
                            <td>{{ $item->property_name ?? '-' }}</td>
                            <td title="{{$item->property_address ?? '-'}}"><div class="maintainht">{{ $item->property_address ?? '-' }}</div></td>
                            <td>{{ $item->manager_name ?? '-' }}</td>
                            <td> {{ $item->manager_email ?? '-' }}</td>
                            <td> {{ $item->manager_phone ?? '-' }}</td>


                        </tr>
                             @endforeach   
            
                        </tbody>
                    </table>

                     @include('admin.common.delete-script',['venues.destroy'] ) 