	<?php
		$trans = trans('global.are_you_sure_delete');
	?>
	<script>

		function checkDelete(){

		return confirm('<?php echo e($trans); ?>');
		}      

	</script>