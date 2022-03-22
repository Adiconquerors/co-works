<footer class="footer">
        <?php
        	$rights_reserved = getSetting('rights_reserved','site_settings');		
        	$site_link = getSetting('site_link','site_settings');		
        ?>
        <span class="d-none d-sm-inline-block">
            <?php echo e($rights_reserved); ?>

</span>
<span class="d-none d-sm-inline-block">
             <?php echo app('translator')->getFromJson('custom.settings.powdby'); ?><a href="<?php echo e($site_link); ?>" target="_blank"> <?php echo app('translator')->getFromJson('custom.settings.dsamaritan'); ?></a>
</span>
</footer>