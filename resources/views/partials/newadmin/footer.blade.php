<footer class="footer">
        <?php
        	$rights_reserved = getSetting('rights_reserved','site_settings');		
        	$site_link = getSetting('site_link','site_settings');		
        ?>
        <span class="d-none d-sm-inline-block">
            {{ $rights_reserved }}
</span>
<span class="d-none d-sm-inline-block">
             @lang('custom.settings.powdby')<a href="{{ $site_link }}" target="_blank"> @lang('custom.settings.dsamaritan')</a>
</span>
</footer>