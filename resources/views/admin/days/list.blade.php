@extends( 'layouts.admin_layout' )

@section( 'admin_head_links' )
  @include('admin.common.head-links')
@endsection

@section( 'dashboard_content' )
 <style>
    .pagination-flot-right{
        float:right;
    }
    .text-align-center{
        text-align:center;
    }
</style>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="db-pageheader d-xl-flex justify-content-between">
    <div class="">
        <h2 class="db-pageheader-title">@lang('custom.days.days')</h2>
        <p class="db-pageheader-text">@lang('custom.days.manage-days')</p>
    </div>
    <div class="d-flex align-items-center">
        <a href="{{ route('days.create') }}" class="btn btn-primary"> {{ $title }}</a>
    </div>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="card-lines-tab">
    <ul class="nav nav-pills card-lines-tab-header" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-listing-tab" data-toggle="pill" href="#pills-listing" role="tab" aria-controls="pills-listing" aria-selected="true">@lang('custom.properties.listing')</a>
        </li>
        
    </ul>
    <div class="tab-content card-listing-tab-body" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
            @if(count($items) > 0)
            <div class="table-responsive listing-table">
                <table class="table first">
                    <thead>
                        <tr>
                            <th>@lang('custom.days.name')</th>
                            <th>@lang('custom.days.description')</th>
                            <th data-orderable="false">@lang('global.app_actions')</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $items as $item )
                        <tr>  

                            <td>
                                <div class="listing-table-head">
                                    <h4 class="listing-table-head-title"><a href="#" class="anchor-title">{{ $item->name }}</a></h4>
                                    
                                </div>
                            </td>
                            <td>
                                <div class="listing-table-date">
                                    <p>{{ $item->description }}</p>
                                </div>
                            </td>
                            
                            
                            <td>
                                <div class="listing-table-action">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('days.edit',$item->slug) }}">@lang('custom.days.edit')</a>

                            <a class="dropdown-item" >                  
                            {!!Form::open([
                            'method'=>'delete',
                            'route' =>['days.destroy',$item->slug],
                            'onclick'=>'return checkDelete();'
                            ])!!}
                            {!!Form::submit('Delete')!!}

                            {!!Form::close()!!} 
                            </a>


                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                   

                      @endforeach



                    </tbody>


              
                </table>



                <ul class="pagination pagination-flot-right">

                {{ $items->links() }}

                </ul>
            </div>

             @else
            <h4 class="text-align-center">@lang('custom.days.no-records')</h4>
            @endif

        </div>

            

        @include('admin.common.delete-script',['days.destroy'] ) 



@stop

@section( 'admin_script_links' )
    @include('admin.common.script-links')
@endsection