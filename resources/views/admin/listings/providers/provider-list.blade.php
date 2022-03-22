<style>
.table-collapse{
   border-collapse: collapse; border-spacing: 0; width: 100%;
}
</style>
<div class="">
  <table class="table table-striped table-bordered dt-responsive nowrap td_m table-collapse" id="datatable">
    <thead>
      <tr class="empty-background">
        <th>@lang('custom.providers.property-id')</th>
        <th>@lang('custom.providers.provider-details')</th>
        <th>@lang('custom.providers.gstin-details')</th>
        <th>@lang('custom.providers.bank-details')</th>
        <th>@lang('global.app_actions')</th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $item)
      @php
      $provider_details = \App\User::find( $item->customer_id )
      @endphp
      <tr class="gradeX" id="gradex">
        <td>
          {{$item->id}}
        </td>
        <!-- provider details -->
        <td>
          <ul>
            <li>
              <p class="text-dark text-left">{{ $provider_details ? $provider_details->name : '-' }}</p>
            </li>
            <li><a href="javascript:void(0);">{{ $provider_details ? $provider_details->email : '-' }}</a>
            </li>
            <li>
              <p class="text-dark text-left">{{ $provider_details ? $provider_details->mobile : '-' }}</p>
            </li>
            <li>
              <label>
                {{ $item->company ?? 'x' }}
              </label>
            </li>

          </ul>
        </td>
        <!-- end provider details -->
        <td>
          
            {{$item->gst  ?? ''}}  
        </td>
        <!-- bank details -->
        <td>
          <ul>

            <li>
              <p class="text-dark text-left">{{ $item->bank_name ?? '-'}}</p>
            </li>

            <li>
              <p class="text-dark text-left">{{ $item->account_holder_name ?? '-'}}</p>
            </li>

            <li>
              <p class="text-dark text-left">{{ $item->account_number ?? '-'}}</p>
            </li>

            <li>
              <p class="text-dark text-left">{{ $item->ifsc_code ?? '-'}}</p>
            </li>
          </ul>
        </td>
        <!-- end details -->
        <td class="actions">
          <br />
          <br />
          <!-- test -->
          <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <ul class="dropdown-menu">

              <li><a href="{{ route('prop.edit',$item->slug) }}" class="dropdown-item">@lang('custom.providers.edit-property')</a></li>

            </ul>
          </div>
          <!-- end test -->
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>