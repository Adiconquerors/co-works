<?php $__env->startSection( 'new_admin_head_links' ); ?>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'new_content' ); ?>
 <style>
    .table-collapse{
        border-collapse: collapse; border-spacing: 0; width: 100%;
    }
    .ar-img{
        border-radius:10px;
    }
</style> 

     <?php echo $__env->make('admin.common.breadcrumbs', compact('route','active_class','title') , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- table -->
                         <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap table-collapse">
                                        <thead>
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('custom.articles.image'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.articles.name'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.articles.sub-space-type'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('custom.app_actions'); ?></th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                          <?php $__currentLoopData = $article; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                            <?php
                                                $article_sub_space_types = $art->sub_space_type;
                                                 $articles_impath = getDefaultimgagepath($art->image,'articles','')
                                            ?>
                         
                                        <tr>
                                            
                                             <td>
                                                <a href="javascript:void(0);">
                                                <img src="<?php echo e($articles_impath); ?>" width="100" height="70" class="ar-img"> 
                                                </a>
                                               </td>   
                                              
                                         
                                            <td><?php echo e($art->name); ?></td>

                                                                                     
                                            <td><?php echo e($article_sub_space_types->name); ?></td>
                                            <td class="actions">
                                                    <a href="<?php echo e(route('articles.show',$art->id)); ?>" class="hidden on-editing save-row"><i class="far fa-eye"></i></a>
                                                   
                                                    <a href="<?php echo e(route( 'articles.edit',$art->id )); ?>" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>

                                           <a  href="javascript:void(0);" >         
                                             <?php echo Form::open([
                                                'method'=>'delete',
                                                'route' =>['articles.destroy',$art->id],
                                                'onclick'=>'return checkDelete();'
                                                ]); ?>

                                                
                                                <button type="submit" class="on-default remove-row">
                                                   <i class="far fa-trash-alt"></i> 
                                                </button>

                                                <?php echo Form::close(); ?> 
                                              </a>

                                                
                                                </td>

                                        </tr>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                            
                                        </tbody>
                                    </table>

                                     <?php echo $__env->make('admin.common.delete-script',['articles.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

                                </div>
                            </div>
                        </div>

                   

                <!-- end Table -->
<?php $__env->stopSection(); ?>

    <?php $__env->startSection( 'new_admin_js_scripts' ); ?>  
    
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

    <?php $__env->stopSection(); ?>       


<?php echo $__env->make('layouts.new_admin_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>