@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
   
@endsection

@section( 'new_content' )
 <style>
    .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
    }
    .ar-img{
        border-radius:10px;
    }
</style> 

     @include('admin.common.breadcrumbs', compact('route','active_class','title') )

                <!-- table -->
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                                        <thead>
                                        <tr>
                                            <th>@lang('custom.articles.image')</th>
                                            <th>@lang('custom.articles.name')</th>
                                            <th>@lang('custom.articles.sub-space-type')</th>
                                            <th>@lang('custom.app_actions')</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                          @foreach( $article as $art ) 
                                            @php
                                                $article_sub_space_types = $art->sub_space_type;
                                                 $articles_impath = getDefaultimgagepath($art->image,'articles','')
                                            @endphp
                         
                                        <tr>
                                            
                                             <td>
                                                <a href="javascript:void(0);">
                                                <img src="{{$articles_impath}}" width="100" height="70" class="ar-img"> 
                                                </a>
                                               </td>   
                                              
                                         
                                            <td>{{ $art->name }}</td>

                                                                                     
                                            <td>{{ $article_sub_space_types->name }}</td>
                                            <td class="actions">
                                                    <a href="{{ route('articles.show',$art->id) }}" class="hidden on-editing save-row"><i class="far fa-eye"></i></a>
                                                   
                                                    <a href="{{ route( 'articles.edit',$art->id ) }}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                                           <a  href="javascript:void(0);" >         
                                             {!!Form::open([
                                                'method'=>'delete',
                                                'route' =>['articles.destroy',$art->id],
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

                                     @include('admin.common.delete-script',['articles.destroy'] ) 

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

