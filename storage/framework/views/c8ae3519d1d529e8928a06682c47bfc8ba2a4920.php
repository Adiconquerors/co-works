<?php $__env->startSection( 'admin_head_links' ); ?>
  <?php echo $__env->make('admin.common.head-links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'dashboard_content' ); ?>
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
        <h2 class="db-pageheader-title"><?php echo app('translator')->getFromJson('custom.days.days'); ?></h2>
        <p class="db-pageheader-text"><?php echo app('translator')->getFromJson('custom.days.manage-days'); ?></p>
    </div>
    <div class="d-flex align-items-center">
        <a href="<?php echo e(route('days.create')); ?>" class="btn btn-primary"> <?php echo e($title); ?></a>
    </div>
</div>
</div>
</div>
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
<div class="card-lines-tab">
    <ul class="nav nav-pills card-lines-tab-header" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-listing-tab" data-toggle="pill" href="#pills-listing" role="tab" aria-controls="pills-listing" aria-selected="true"><?php echo app('translator')->getFromJson('custom.properties.listing'); ?></a>
        </li>
        
    </ul>
    <div class="tab-content card-listing-tab-body" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-listing" role="tabpanel" aria-labelledby="pills-listing-tab">
            <?php if(count($items) > 0): ?>
            <div class="table-responsive listing-table">
                <table class="table first">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('custom.days.name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('custom.days.description'); ?></th>
                            <th data-orderable="false"><?php echo app('translator')->getFromJson('global.app_actions'); ?></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>  

                            <td>
                                <div class="listing-table-head">
                                    <h4 class="listing-table-head-title"><a href="#" class="anchor-title"><?php echo e($item->name); ?></a></h4>
                                    
                                </div>
                            </td>
                            <td>
                                <div class="listing-table-date">
                                    <p><?php echo e($item->description); ?></p>
                                </div>
                            </td>
                            
                            
                            <td>
                                <div class="listing-table-action">
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo e(route('days.edit',$item->slug)); ?>"><?php echo app('translator')->getFromJson('custom.days.edit'); ?></a>

                            <a class="dropdown-item" >                  
                            <?php echo Form::open([
                            'method'=>'delete',
                            'route' =>['days.destroy',$item->slug],
                            'onclick'=>'return checkDelete();'
                            ]); ?>

                            <?php echo Form::submit('Delete'); ?>


                            <?php echo Form::close(); ?> 
                            </a>


                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                   

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                    </tbody>


              
                </table>



                <ul class="pagination pagination-flot-right">

                <?php echo e($items->links()); ?>


                </ul>
            </div>

             <?php else: ?>
            <h4 class="text-align-center"><?php echo app('translator')->getFromJson('custom.days.no-records'); ?></h4>
            <?php endif; ?>

        </div>

            

        <?php echo $__env->make('admin.common.delete-script',['days.destroy'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 



<?php $__env->stopSection(); ?>

<?php $__env->startSection( 'admin_script_links' ); ?>
    <?php echo $__env->make('admin.common.script-links', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make( 'layouts.admin_layout' , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>