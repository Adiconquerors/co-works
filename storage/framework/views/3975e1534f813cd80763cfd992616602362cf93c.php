 <style>
     .sty-cen{
        text-align:center;
     }
 </style>
 <table class="table table-bordered table-striped ajaxTable <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency_delete_multi')): ?> <?php if( request('show_deleted') != 1 ): ?> dt-select <?php endif; ?> <?php endif; ?>">
                <thead>
                    <tr>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currency_delete_multi')): ?>
                            <?php if( request('show_deleted') != 1 ): ?>
                            <th class="sty-cen">
                                <input type="checkbox" id="select-all" />
                            </th><?php endif; ?>
                        <?php endif; ?>

                        <th><?php echo app('translator')->getFromJson('global.currencies.fields.name'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.currencies.fields.symbol'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.currencies.fields.code'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.currencies.fields.rate'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.currencies.fields.status'); ?></th>
                        <th><?php echo app('translator')->getFromJson('global.currencies.fields.is_default'); ?></th>
                        <?php if( request('show_deleted') == 1 ): ?>
                        <th><?php echo app('translator')->getFromJson('custom.app_actions'); ?></th>
                        <?php else: ?>
                        <th>&nbsp;</th>
                        <?php endif; ?>
                    </tr>
                </thead>
            </table>