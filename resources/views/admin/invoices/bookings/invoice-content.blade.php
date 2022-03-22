@section( 'new_admin_internal_styles' )
<style>
  body{
  background:#EEE;
  
}
.invoice{
  width:970px !important;
  margin:50px auto;
  .invoice-header{
    padding:25px 25px 15px;
    h1{
      margin:0
    }
    .media{
      .media-body{
        font-size:.9em;
        margin:0;
      }
    }
  }
  .invoice-body{
    border-radius:10px;
    padding:25px;
    background:#FFF;
  }
  .invoice-footer{
    padding:15px;
    font-size:0.9em;
    text-align:center;
    color:#999;
  }
}
.logo{
  max-height:70px;
  border-radius:10px;
}
.dl-horizontal{
  margin:0;
  dt{
        float: left;
    width: 80px;
    overflow: hidden;
    clear: left;
    text-align: right;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  dd{
    margin-left:90px;
  }
}
.rowamount{
  padding-top:15px !important;
}
.rowtotal{
  font-size:1.3em;
}
.colfix{
  width:12%;
}
.mono{
  font-family:monospace;
}
.sty-fr{
  float:right;
}
.sty-im{
  height: 38px; padding: 8px;
}
.sty-hr{
  margin:3px 0 5px;
}
</style>
@endsection

  <?php
    $property = \App\Property::find( $item->property_id );
    $invoice = \App\Invoice::find( $item->invoice_id );
    $amount = $item->amount;
    $gstin = $item->gstin;
    $site_title = getSetting('site_title','site_settings');
    $contact_email = getSetting('contact_email','site_settings');
    $country_code = getSetting('country_code','site_settings');
    $site_phone = getSetting('site_phone','site_settings');
    $site_address = getSetting('site_address','site_settings');
  ?>
<div class="container invoice">
  <div class="invoice-header">
    <div class="row">
      <div class="col-xs-8">
        <h1>@lang('custom.invoicepdf.invoice')</h1>
        <h1 class="sty-fr">{{ ucfirst( $item->paymentstatus ) }}</h1>
        <h4 class="text-muted">@lang('custom.invoicepdf.id'): {{$item->id }} | @lang('custom.invoicepdf.date'): </h4>
      </div>
      <div class="col-xs-4">
        <div class="media">
          <div class="media-left">
            <img class="media-object logo sty-im" src="{{ PUBLIC_ASSETS }}images/logo2.png">
          </div>
          <ul class="media-body list-unstyled">
            <li><strong>{{ $site_title }}</strong></li>
           
            <li>{{ $contact_email }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="invoice-body">
    <div class="row">
      <div class="col-xs-5">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">@lang('custom.invoicepdf.company-details')</h3>
          </div>
          <div class="panel-body">
            <dl class="dl-horizontal">
              <dt>@lang('custom.invoicepdf.name')</dt>
              <dd><strong>{{ $site_title }}</strong></dd>
              <dt>@lang('custom.invoicepdf.industry')</dt>
              <dd>@lang('custom.invoicepdf.real-estate')</dd>
              <dt>@lang('custom.invoicepdf.address')</dt>
              <dd>{{$site_address}}</dd>
              <dt>@lang('custom.invoicepdf.phone')</dt>
              <dd>{{$country_code}} {{$site_phone}}</dd>
              <dt>@lang('custom.invoicepdf.email')</dt>
              <dd>{{ $contact_email }}</dd>
             
          </div>
        </div>
      </div>
      <div class="col-xs-7">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">@lang('custom.invoicepdf.company-details')</h3>
          </div>
          <div class="panel-body">
            <dl class="dl-horizontal">
              <dt>@lang('custom.invoicepdf.customer-name')</dt>
              <dd>{{ $item->customer_name ? $item->customer_name : '-' }}</dd>
              <dt>@lang('custom.invoicepdf.company-name')</dt>
              <dd>{{ $property ? $property->company : '-' }}</dd>
              <dt>@lang('custom.invoicepdf.company-address')</dt>
              <dd>{{ $invoice ? $invoice->company_address : '-' }}</dd>
              <dt>@lang('custom.invoicepdf.phone')</dt>
              <dd>{{ $item->customer_mobile ?? '-' }}</dd>
              <dt>@lang('custom.invoicepdf.email')</dt>
              <dd>{{ $item->customer_email }}</dd>
              
              <dt>&nbsp;</dt>
              <dd>&nbsp;</dd>
          </div>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">@lang('custom.invoicepdf.properties')</h3>
      </div>
      <table class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>@lang('custom.invoicepdf.item-details')</th>
            <th class="text-center colfix">@lang('custom.invoicepdf.no-of-seats')</th>
            <th class="text-center colfix">@lang('custom.invoicepdf.gstin')</th>
            <th class="text-center colfix">@lang('custom.invoicepdf.amount')</th>
            <th class="text-center colfix">@lang('custom.invoicepdf.total')</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            
            <td>
              {{ $property ? $property->name : '-' }}
            </td>
            <td class="text-right">
              <span class="mono">{{ $item->no_of_seats }}</span>
            </td>
            <td class="text-right">
              <span class="mono">{{ $gstin }}%</span>
            </td> 
             <td class="text-right">
              <span class="mono">{{ $amount }}</span>
            </td>
             <td class="text-right">
              <span class="mono">{{ $amount + ( $gstin/100 * $amount ) }}</span>
            </td>  
           
          </tr>

       
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-xs-7">
        <div class="panel panel-default">
          <div class="panel-body">
            <i>@lang('custom.invoicepdf.comments-notes')</i>
            <hr class="sty-hr" /> {{ $item->description }}
          </div>
        </div>
      </div>
  
    </div>

  </div>
  <div class="invoice-footer">
    @lang('custom.eforms.thank')
    <br/> @lang('custom.eforms.soon')
    <br/>
    <strong>~@lang('custom.eforms.cowork')~</strong>
  </div>
</div>