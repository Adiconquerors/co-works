<div class="col-xl-3 col-md-6">
       <div class="card-box tilebox-two tilebox-success">
            <i class="mdi mdi-currency-usd float-right text-dark"></i>
            <h6 class="text-success text-uppercase m-b-15 m-t-10">@lang('custom.dashboard.total-inquiries')</h6>

            <h2 class="m-b-10"><span data-plugin="counterup">{{$total_inquiries}}</span></h2>
        </div>
    </div>

       <div class="col-xl-3 col-md-6">
        <div class="card-box tilebox-two tilebox-pink">
            <i class="mdi mdi-comment-multiple-outline float-right text-dark"></i>
            <a href="javascript:void(0);">
            <h6 class="text-pink text-uppercase m-b-15 m-t-10"> @lang('custom.dashboard.unpaid-invoices')</h6>
            </a>
            <h2 class="m-b-10" data-plugin="counterup">{{ $unpaid_invoices }}  </h2>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
       <div class="card-box tilebox-two tilebox-success">
            <i class="mdi mdi-currency-usd float-right text-dark"></i>
            <h6 class="text-success text-uppercase m-b-15 m-t-10">@lang('custom.dashboard.paid-invoices')</h6>

            <h2 class="m-b-10"><span data-plugin="counterup">{{$paid_invoices}}</span></h2>
        </div>
    </div>