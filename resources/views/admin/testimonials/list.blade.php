@extends('layouts.new_admin_layout')


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
                                {{ ucwords( $active_class ) }}
                            </h4>
                            <div class="breadcrumb p-0 m-0">
                                
                                    <a href="{{ route('testimonials.create') }}" class="btn btn-purple waves-effect waves-light" ><i class="fas fa-plus-square">
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
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                                        <thead>
                                        <tr>
                                            <th>@lang('custom.users.image')</th>
                                            <th>@lang('custom.users.name')</th>
                                            <th>@lang('global.app_actions')</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                          @foreach( $items as $item ) 
                                            @php
                                             $image = $item->image;
                                            @endphp
                         
                                        <tr>
                                             
                                             <td>
                                                <a href="javascript:void(0);">
                                                    <img src="{{getDefaultimgagepath($image,'testimonials','')}}" width="100" height="70" class="sty-br">
                                                </a>
                                               </td>   
                                            <td>{{ $item->name }}</td>

                                           
                                            <td class="actions">
                                                    <a href="{{ route('testimonials.show',$item->slug) }}" class="hidden on-editing save-row"><i class="far fa-eye"></i></a>
                                                   
                                                    <a href="{{ route( 'testimonials.edit',$item->slug ) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                                           <a  href="javascript:void(0);" >         
                                             {!!Form::open([
                                                'method'=>'delete',
                                                'route' =>['testimonials.destroy',$item->slug],
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

                                     @include('admin.common.delete-script',['testimonials.destroy'] ) 

                                </div>
                            </div>
                        </div>

                   

                <!-- end Table -->
@stop

    @section( 'new_admin_js_scripts' )  
     
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
            

        </script>

    @endsection       
