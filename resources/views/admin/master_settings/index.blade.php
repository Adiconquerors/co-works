@extends('layouts.new_admin_layout')

@section( 'new_admin_head_links' )
    <style>
    .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
    }
    .sty-br{
        border-radius: 10px;
    }
    .dtr-data{
        display: inline-flex;
        padding-left: 2px;
    }
</style>
@endsection

@section( 'new_content' )

       <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="page-title">
                                {{ ucwords( $active_class ) }}
                            </h4>
                         
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
                                            <th>@lang('global.master-settings.fields.module')</th>
                                            <th>@lang('global.master-settings.fields.key')</th>
                                            <th>@lang('custom.settings.moduletype')</th>
                                            <th>@lang('global.master-settings.fields.description')</th>
                                            <th>@lang('global.app_actions')</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                          @foreach( $master_setting as $item ) 
                                            
                                        <tr>
                                      
                                            <td>{{ $item->module }} </td>

                                            <td>{{ $item->key }} </td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->moduletype }}</td>

                                            <td>
                                                    <a href="{{ url('admin/mastersettings/settings/view', $item->slug) }}" class="btn btn-xs btn-primary">@lang('global.app_settings')</a>
                                                        
                                                    <?php
                                                        $master_edit = $item->id;
                                                        $medit = url("admin/master_settings/".$master_edit."/edit");
                                                    ?>   

                                                    <a href="{{ $medit }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>

                                      

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

