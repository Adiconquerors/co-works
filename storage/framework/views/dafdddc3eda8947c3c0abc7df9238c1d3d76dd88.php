

<style type="text/css">
        .icon1 {
             align: center;
        }
        .icon2 {
        	  align: center;
        }
        .styy_rmm{
        	margin-top: 60px;
        }
        #styy_ic{
        	text-align: center; font-size: 18px;
        }
        .styy_lc{
        	padding:13px 17px 13px 17px; border-radius: 50px; border: 2px solid #eaeaea; background-color: #fafafa; margin-top: 50px;
        }
        .styy_req{
        	text-align: center; margin-top: 20px; font-family: lato;
		font-size: 22px;
        }
        #styy_iccq{
        	text-align: center;font-size: 18px;
        }
        #styy_llcc{
        	padding:13px 17px 13px 17px; border-radius:50px; border: 2px solid #eaeaea; background-color: #fafafa; margin-top: 30px;
        }
        .styy_ddbs{
        	text-align: center; margin-top: 20px; font-family: lato; font-size: 22px;
        }
   @media(max-width: 767px){
   	      .row {
   	      	    width: 100%;
   	      }
   	      .icon1 {
   	      	 float: left;
   	      	 margin-top: 15px;
   	      	 margin-left: 18px;
   	      }
   	      .icon2 {
   	      	float: right;
   	      	margin-top: 18px;
   	      	margin-right: -5px;
   	      }
   }


</style>

<div class="row sty_rmm">
	<div class="col-md-6">
		<?php if ( ( ! empty( $steps['step1_active'] ) ) ) { ?>
		<a href="<?php echo e(route('install.index')); ?>">
		<?php } ?>
	   
		<div class="<?php echo ! empty( $steps['step1_active'] ) ? $steps['step1_active'] : 'stage'; ?>">
			<div class="icon1">
			<div class="icon" id="styy_ic" >
				<span class="styy_lc">
		     1</div>
		<h4 class="styy_req">Requirements</h4>
	 </div>
	</div>
		<?php if ( ! empty( $steps['step1_active'] ) ) { ?>
		</a>
		<?php } ?>
	</div>
	
	<div class="col-md-6">
		<?php if ( ! empty( $steps['step2_active'] ) ) { ?>
		<a href="<?php echo e(route('install.project')); ?>">
		<?php } ?>
		
		<div class="<?php echo ! empty( $steps['step2_active'] ) ? $steps['step2_active'] : 'stage'; ?>">
			<div class="icon2">
			<div class="icon" id="styy_iccq"><span id="styy_llcc">2</div>
			<h4 class="styy_ddbs">Database Details</h4>
		</div>
		</div>
		<?php if ( ! empty( $steps['step2_active'] ) ) { ?>
		</a>
		<?php } ?>
	</div>
	
</div>