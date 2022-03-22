@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
   @include( 'partials.newadmin.common.datatables.datatables-head-links' )
@endsection

@section( 'new_content' )
<style>
.table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
}
</style>
       <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">
                                @lang('global.sms-gateways.title')
                            </h4>
                            <div class="breadcrumb p-0 m-0">

                                    <a href="{{ route('admin.sms_gateways.create') }}" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
                                    </i>
                                    @lang('global.app_add_new')</a>

                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                        </div>
                    </div>

                <!-- table -->
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                                        <thead>
                                        <tr>
                                            <th>@lang('global.sms-gateways.fields.name')</th>
                                            <th>@lang('global.sms-gateways.fields.key')</th>
                                            <th>@lang('global.sms-gateways.fields.description')</th>
                                            <th>@lang('custom.membershipfees.actions')</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                          @foreach( $query as $item )

                                        <tr>

                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->key }}</td>
                                            <td>{{ $item->description }}</td>

                                            <td class="actions">

                                                    <a href="{{ route( 'admin.sms_gateways.edit',$item->id ) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                                           <a  href="javascript:void(0);" >
                                             {!!Form::open([
                                                'method'=>'delete',
                                                'route' =>['admin.sms_gateways.destroy',$item->id],
                                                'onclick'=>'return checkDelete();'
                                                ])!!}

                                                <button type="submit" class="on-default remove-row">
                                                   <i class="far fa-trash-alt"></i>
                                                </button>

                                                {!!Form::close()!!}
                                        	</a>
                                            </td>

                                        </tr>
                                             @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>



                <!-- end Table -->
@stop

    @section( 'new_admin_js_scripts' )
     @include( 'partials.newadmin.common.datatables.datatables-script-links' )
        <script>
            $(document).ready(function () {
                "use strict";

                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    //ajax: "{{ route( 'articles.index' ) }}",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });

        </script>

    @endsection

