<div class="col-xl-3 col-md-6">
                <div class="card-box tilebox-two tilebox-pink">
                    <i class="mdi mdi-comment-multiple-outline float-right text-dark"></i>
                    <a href="{{route('thismonthinquiries.export')}}">
                    <h6 class="text-pink text-uppercase m-b-15 m-t-10"> @lang('custom.dashboard.inquiries-this-month') ( {{ \Carbon\Carbon::now()->format('M') }} )</h6>
                    </a>
                    <h2 class="m-b-10" data-plugin="counterup">{{ $inquiries_count }}  </h2>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card-box tilebox-two tilebox-info">
                    <i class="mdi mdi-account-multiple float-right text-dark"></i>
                    <h6 class="text-info text-uppercase m-b-15 m-t-10">
                     <a href="{{ route('users.export') }}" > 
                        @lang('custom.dashboard.registered-users')
                    </a>
                    </h6>
                    <h2 class="m-b-10"><span data-plugin="counterup">{{ $total_users_count }}</span></h2>
                </div>
            </div>