<span>
<?php
$controller = getController( 'controller' );
$action = getController( 'action' );
?>



    <a href="<?php echo e(route( $routeKey.'.show', $row->id )); ?>"
       class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('global.app_view'); ?></a>



    <?php
    $noeditcontrollers = [ 'DatabaseBackupsController', 'PaymentGatewaysController' ];
    if ( ! isEnable('debug') ) {
        array_push($noeditcontrollers, 'ModulesManagementsController');
    }
    if ( 'TimeEntriesController' === $controller ) {
        if ( ! empty( $row->task->billed ) && 'yes' === $row->task->billed ) {
            array_push( $noeditcontrollers, 'TimeEntriesController' );
        }
    }
    ?>
    <?php if( ! in_array( $controller, $noeditcontrollers ) ): ?>
    <?php
    $title = trans('global.app_edit');
    if ( 'SendSmsController' === $controller ) {
        $title = trans('sendsms::global.send-sms.re-send');
    }
    ?>
    <?php
    if ( in_array($controller, array( 'QuoteTasksController', 'QuotesRemindersController', 'QuotesNotesController' )) ) {
    ?>
    <a href="<?php echo e(route($routeKey.'.edit', [ 'quote_id' => $row->quote_id, 'id' => $row->id ])); ?>" class="btn btn-xs btn-info"><?php echo $title; ?></a>
    <?php } elseif ( in_array($controller, array( 'InvoiceTasksController', 'InvoiceRemindersController', 'InvoiceNotesController' )) ) {
        ?>
        <a href="<?php echo e(route($routeKey.'.edit', [ 'invoice_id' => $row->invoice_id, 'id' => $row->id ])); ?>" class="btn btn-xs btn-info"><?php echo $title; ?></a>
        <?php
    } elseif ( in_array($controller, array( 'ProjectTasksController', 'TimeEntriesController', 'ProjectRemindersController', 'ProjectNotesController', 'MileStonesController', 'ProjectTicketsController', 'ProjectDiscussionController' )) ) {
        if ( ! in_array( $action, array('projectDiscussionComments') ) ) {
        ?>
    <a href="<?php echo e(route( $routeKey.'.edit', [ 'project_id' => $row->project_id, 'id' => $row->id ] )); ?>"
       class="btn btn-xs btn-info"><?php echo $title; ?></a>
        <?php
        }
    } elseif ( in_array($controller, array( 'ProposalTasksController', 'ProposalsRemindersController', 'ProposalsNotesController' )) ) {
        ?>
    <a href="<?php echo e(route( $routeKey.'.edit', [ 'proposal_id' => $row->proposal_id, 'id' => $row->id ] )); ?>"
       class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_edit'); ?></a>
        <?php
    }elseif ( in_array($controller, array( 'ContractTasksController', 'ContractsRemindersController', 'ContractsNotesController' )) ) {
        ?>
    <a href="<?php echo e(route( $routeKey.'.edit', [ 'contract_id' => $row->contract_id, 'id' => $row->id ] )); ?>"
       class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_edit'); ?></a>
        <?php
    }
    elseif( 'ClientProjectsController' === $controller && 'invoices' === $action ) {
    ?>
        <a href="<?php echo e(route( 'admin.client_projects.invoice-project-edit', [ 'project_id' => $row->project_id, 'id' => $row->id ] )); ?>"
       class="btn btn-xs btn-primary"><?php echo $title; ?></a>
    <?php
    }else { ?>
    <a href="<?php echo e(route($routeKey.'.edit', $row->id)); ?>" class="btn btn-xs btn-info"><?php echo $title; ?></a>
    <?php } ?>
    <?php endif; ?>

<?php
if ( 'LanguagesController' === $controller ) {
    $current_language = \Cookie::get('language');

    ?>
   
     <?php if( 'Yes' === $row->is_default ): ?>
        <a href="javascript:void(0);" class="btn btn-xs btn-info" title="<?php echo app('translator')->getFromJson('custom.deault-language'); ?>"><?php echo app('translator')->getFromJson('global.app_default'); ?></a>
        <?php else: ?>
        <a href="<?php echo e(url('admin/make-default-language/' . $row->id)); ?>" class="btn btn-xs btn-success" title="<?php echo app('translator')->getFromJson('custom.deault-language'); ?>"><?php echo app('translator')->getFromJson('global.app_make_default'); ?></a>
        <?php endif; ?>   
    <?php
}
if ( in_array($controller, ['ContactsController'] ) ) {
    $contact_types = $row->contact_type->pluck('id')->toArray();
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'edit')): ?>
        <a href="javascript:void(0);" class="btn btn-xs btn-success" onclick="sendMail('sendcontactemail', '<?php echo e($row->id); ?>', '<?php echo e($row->id); ?>')"><?php echo app('translator')->getFromJson('global.app_send_email'); ?></a>

    <?php endif; ?>
    <?php if( ! in_array( LEADS_TYPE, $contact_types ) ): ?>
        <?php if( 'no' === $row->is_user && Gate::allows('user_create') ): ?>
        <a href="<?php echo e(route('admin.users.create', $row->id)); ?>" class="btn btn-xs btn-warning"><?php echo app('translator')->getFromJson('global.app_create_user'); ?></a>
        <?php elseif( Gate::allows('user_edit') ): ?>
        <a href="<?php echo e(route('admin.users.edit', $row->id)); ?>" class="btn btn-xs btn-warning"><?php echo app('translator')->getFromJson('global.app_edit_user'); ?></a>
        <?php endif; ?>
    <?php endif; ?>
    <?php
}
if ( 'CurrenciesController' === $controller ) {
    ?>
   
        <?php if( $row->is_default == 'yes'): ?>
            <a href="javascript:void(0);" class="btn btn-xs btn-default"><?php echo app('translator')->getFromJson('global.app_make_default'); ?></a>
        <?php else: ?>
            <a href="<?php echo e(route('currency.makedefault', $row->id)); ?>" class="btn btn-xs btn-success"><?php echo app('translator')->getFromJson('global.app_make_default'); ?></a>
        <?php endif; ?>
    
    <?php
}
if ( 'TemplatesController' === $controller ) {
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'edit')): ?>
        <a href="<?php echo e(route('admin.templates.duplicate', $row->id)); ?>" class="btn btn-xs btn-success"><?php echo app('translator')->getFromJson('others.duplicate'); ?></a>
    <?php endif; ?>
    <?php
}
if ( 'ClientProjectsController' === $controller && 'index' === $action ) {
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'duplicate')): ?>
        <a href="<?php echo e(route('admin.client_projects.duplicate', $row->id)); ?>" class="btn btn-xs btn-success" onclick="return confirm(window.are_you_sure_duplicate)"><?php echo app('translator')->getFromJson('others.duplicate'); ?></a>
    <?php endif; ?>
    <?php
}
if ( 'UsersController' === $controller ) {
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'change_status')): ?>
        <?php if( Auth::id() != $row->id ): ?>
            <?php if( 'Active' === $row->status ): ?>
                <a href="<?php echo e(route('admin.users.changestatus', $row->id)); ?>" class="btn btn-xs btn-success"><?php echo app('translator')->getFromJson('global.users.suspend'); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('admin.users.changestatus', $row->id)); ?>" class="btn btn-xs btn-success"><?php echo app('translator')->getFromJson('global.users.activate'); ?></a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php
}
if ( 'MasterSettingsController' === $controller ) {
    ?>

        <a href="<?php echo e(url('admin/mastersettings/settings/view', $row->slug)); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_settings'); ?></a>
        <?php if(  env('APP_DEV') ): ?>  
        <a href="<?php echo e(url('admin/mastersettings/settings/add-sub-settings', $row->slug)); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_add_key'); ?></a>
        <?php endif; ?>

    <?php
}
if ( 'SiteThemesController' === $controller ) {
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'settings')): ?>
        <?php if( $row->is_active == 1 ): ?>
            <a href="<?php echo e(url('admin/make/default/theme', $row->id)); ?>" class="btn btn-xs btn-success"><?php echo app('translator')->getFromJson('global.app_default'); ?></a>
        <?php else: ?>
            <a href="<?php echo e(url('admin/make/default/theme', $row->id)); ?>" class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('global.app_make_default'); ?></a>
        <?php endif; ?>
        <?php if( ! isDemo() ): ?>
        <a href="<?php echo e(url('admin/theme/settings', $row->slug)); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_settings'); ?></a>
        <a href="<?php echo e(url('admin/theme/settings/add-sub-settings', $row->slug)); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_add_key'); ?></a>
        <?php endif; ?>
    <?php endif; ?>
    <?php
}
if ( 'ModulesManagementsController' === $controller ) {
    $label = trans( 'modulesmanagement::global.modules-management.active');
    $title = trans( 'modulesmanagement::global.modules-management.deactivate');
    $class = 'success';

        $label = trans( 'modulesmanagement::global.modules-management.active');

        $class = 'success';
        if ( 'No' === $row->enabled ) {
            $label = trans( 'modulesmanagement::global.modules-management.inactive');
            $title = trans( 'modulesmanagement::global.modules-management.activate');
            $class = 'warning';
        }
        ?>

        <a href="<?php echo e(route('admin.modules-management.changestatus', $row->id)); ?>" class="btn btn-xs btn-<?php echo e($class); ?> <?php if( 'no' === $row->can_inactive ): ?> disabled <?php endif; ?>" title="<?php echo e($title); ?>" <?php if( 'no' === $row->can_inactive ): ?> onclick="return false;" disabled <?php endif; ?>><?php echo e($label); ?></a>


        <?php if( ! isDemo() && 'Custom' === $row->type ): ?>
        <a href="<?php echo e(url('admin/plugin/settings', $row->slug)); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_settings'); ?></a>
        <a href="<?php echo e(url('admin/plugin/settings/add-sub-settings', $row->slug)); ?>" class="btn btn-xs btn-info"><?php echo app('translator')->getFromJson('global.app_add_key'); ?></a>
        <?php endif; ?>
        <?php
    //}
}

if ( 'IncomesController' === $controller ) {
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($gateKey.'receipt')): ?>
    <a href="<?php echo e(route('admin.incomes.receipt', $row->slug)); ?>" class="btn btn-xs btn-success"><?php echo app('translator')->getFromJson('custom.incomes.receipt'); ?></a>
    <?php endif; ?>
    <?php
}
if ( 'OrdersController' === $controller ) {
        $class = 'info';
        if ( 'Pending' === $row->status ) {
            $class = 'warning';
        }
        if ( 'Accepted' === $row->status || 'Active' === $row->status ) {
            $class = 'success';
        }
        if ( 'Cancelled' === $row->status ) {
            $class = 'warning';
        }
    ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_cancel')): ?>
        <?php if( in_array($row->status, array( 'Pending', 'Cancelled', 'Returned' ) ) ): ?>


            <div class="btn-group ">
                <button type="button" class="btn btn-success mb-1 btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-arrows-v" aria-hidden="true"></i>&nbsp;<?php echo e(trans('custom.common.mark-as')); ?>&nbsp;<span class="caret"></span>
                </button>
                <div class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo e(route('admin.orders.cancel', [ 'slug' => $row->slug, 'status' => 'Cancelled'])); ?>"><?php echo e(trans('custom.orders.cancel')); ?></a></li>

                    <li><a class="dropdown-item" href="<?php echo e(route('admin.orders.cancel', [ 'slug' => $row->slug, 'status' => 'Active'] )); ?>"><?php echo e(trans('custom.orders.active')); ?></a></li>

                    <li><a class="dropdown-item" href="<?php echo e(route('admin.orders.cancel', [ 'slug' => $row->slug, 'status' => 'Pending'] )); ?>"><?php echo e(trans('custom.orders.pending')); ?></a></li>

                    <li><a class="dropdown-item" href="<?php echo e(route('admin.orders.cancel', [ 'slug' => $row->slug, 'status' => 'Returned'] )); ?>"><?php echo e(trans('custom.orders.return')); ?></a></li>

                </div>
            </div>

            <?php
            if ( isCustomer() ) {
            $payment = $row->payment( $row->id );

            $isExpired = false;
            if ( $payment ) {
             $isExpired = \App\Http\Controllers\Admin\PaymentsController::isExpired( $payment );
            }

            if ( ! $isExpired ) {
            ?>
            <a href="<?php echo e(route('admin.orders.payment-now', $row->slug)); ?>" class="btn btn-xs btn-info" onclick="return confirm('<?php echo e(trans("orders::global.orders.app_are_you_sure")); ?>')"><?php echo app('translator')->getFromJson('orders::global.orders.retry'); ?></a>
            <?php }
            }
            ?>

        <?php else: ?>
            <span class="label label-<?php echo e($class); ?> label-many"><?php echo e($row->status); ?></span>
        <?php endif; ?>
    <?php endif; ?>
    <?php if( isCustomer() ): ?>
    <a href="<?php echo e(route('admin.orders.reorder', $row->slug)); ?>" class="btn btn-xs btn-info" onclick="return confirm('<?php echo e(trans("orders::global.orders.app_are_you_sure_reorder")); ?>')"><?php echo app('translator')->getFromJson('orders::global.orders.reorder'); ?></a>
    <?php endif; ?>
    <?php

}
?>
<?php
$candelete = true;
$nodeletecontrollers = array( 'SiteThemesController', 'PaymentGatewaysController' );
if( ! isEnable('debug') ) {
    array_push($nodeletecontrollers, 'MasterSettingsController', 'ModulesManagementsController');
}

if ( 'TimeEntriesController' === $controller ) {
    if ( ! empty( $row->task->billed ) && 'yes' === $row->task->billed ) {
        array_push( $nodeletecontrollers, 'TimeEntriesController' );
    }
}

if ( in_array($controller,  $nodeletecontrollers) ) {
    if ( 'default' === $row->slug ) {
        $candelete = false;
    }
    $candelete = false;
}

if ( in_array($controller, array( 'UsersController' ) ) ) {
    if ( Auth::id() == $row->id ) {
        $candelete = false;
    }
}
if( $candelete ) { ?>

    <?php
    $id = $row->id;
    if ( in_array($controller, array( 'QuoteTasksController', 'QuotesRemindersController', 'QuotesNotesController' )) ) {
        $route = [$routeKey.'.destroy',$row->quote_id, $id ];
    } elseif ( in_array($controller, array( 'InvoiceTasksController', 'InvoiceRemindersController', 'InvoiceNotesController' )) ) {
        $route = [$routeKey.'.destroy',$row->invoice_id, $id ];
    } elseif ( in_array($controller, array( 'ProjectTasksController', 'TimeEntriesController', 'ProjectRemindersController', 'ProjectNotesController', 'MileStonesController', 'ProjectTicketsController', 'ProjectDiscussionController' )) ) {
        $route = [$routeKey.'.destroy',$row->project_id, $id ];
    } elseif ( in_array($controller, array( 'ProposalTasksController', 'ProposalsRemindersController', 'ProposalsNotesController' )) ) {

        $route = [$routeKey.'.destroy',$row->proposal_id, $id ];

    }elseif ( in_array($controller, array( 'ContractTasksController', 'ContractsRemindersController', 'ContractsNotesController' )) ) {

        $route = [$routeKey.'.destroy',$row->contract_id, $id ];

    }
    else {
        $route = [$routeKey.'.destroy', $id];
    }
    if ( 'DatabaseBackupsController' === $controller ) {
        $id = $row->file_name;
        $route = ['admin.databasebackups.delete', $id, $type ];
    }
    if ( 'ContactsController' === $controller ) {
        echo '<a href="'. route('admin.contacts.info', $row->id) .'" class="btn btn-xs btn-danger">'.trans('global.app_delete') . '</a>';
    } else {
    ?>
    <?php echo Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
        'route' => $route)); ?>

    <?php echo Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')); ?>

    <?php echo Form::close(); ?>

    <?php } ?>

<?php } ?>
</span>