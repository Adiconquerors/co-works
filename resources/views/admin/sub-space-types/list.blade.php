@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
   @include( 'partials.newadmin.common.datatables.datatables-head-links' ) 
@endsection

@section( 'new_content' )
<style>
.table-collapse{
    border-collapse: collapse; border-spacing: 0; width: 100%;
}
.sty-br{
    border-radius: 10px;
}
</style>
   <div class="row">
     <div class="col-12">
         <div class="page-title-box">
             <h4 class="page-title">
                Sub Space Types
             </h4>
             <div class="breadcrumb p-0 m-0">
                 
                     <a href="{{ route('space_types.index') }}" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
                     </i>
                     {{ ucwords( $title ) }}</a>
                
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
            <table id="datatables" class="table table-striped table-bordered dt-responsive nowrap table-collapse" >
                <thead>
                <tr>
                    <th>@lang('custom.spacetypes.image')</th>
                    <th>@lang('custom.spacetypes.sub-space-type')</th>
                    <th>@lang('custom.eforms.description')</th>
                     <th>@lang('global.app_actions')</th>
                </tr>
                </thead>


                <tbody>
                  @foreach( $items as $item ) 
                    @php
                      $parents = \App\SpaceType::find($item->parent_id); 
                      $image = $item->image;
                       $default_path = getDefaultimgagepath($image,'space-types');
                    @endphp
        
                <tr>
                    
                     <td>
                        <a href="javascript:void(0);">
                        <img src="{{ $default_path }}" width="100" height="70" class="sty-br"> 
                        </a>
                       </td>   
                 
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->des_one }}</td>
    
                    <td class="actions">
                       @if( ! empty( $item->parent_id ) )
                           
                            <a href="{{ route('space_types.edit',$item->slug,$item->parent_id) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                
                @endif
                       
                        </td>

                </tr>
                     @endforeach   
    
                </tbody>
            </table>

             @include('admin.common.delete-script',['space_types.destroy'] ) 

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
            TableManageButtons.init();

        </script>

    @endsection