<html lang="en">
    <head>

     <style>
        
        body{background: #f5f5f5;    }
            .productlis{  padding: 20px;width: 100%; max-width: 800px; background: #fff; margin: 0 auto; display: block;}
            .productlis h2{ padding: 0px 0 20px; margin: 0; color: #40c8f4;}
            .productlis ul{margin: 0; padding: 0; display: grid; grid-template-columns: auto auto; grid-gap: 10px;}
            .productlis ul li{list-style: none;    border: 1px solid #ccc;
                padding: 15px;}
            .imgea img
            {
              width: 100%;
            }
            .productlis ul li h5{margin: 0;    font-weight: lighter;
                font-size: 18px;}
                .productlis ul li h3 { color:  #cc3333;}
               
                .icons {
                display: flex;
                justify-content: space-between;
                text-align: center;
            }
            .icons span {
                width: 50px;
                height: 50px;    align-items: center;
                border-radius: 100px;
                border: 1px solid #ccc;
                margin: 15px 0 0;
            }
            .icons img {
                width: 35px;
                margin: 8px 0;
            }
            .mte{font-style: italic;   font-weight: bold;}
            .ViewD {
                display: flex;
                justify-content: space-around;
            }
            .ViewD a {
                margin: 15px;
                padding: 10px;
                border: 1px solid #ccc;
                width: 100%;
                text-align: center;
                border-radius: 10px; color: #cc3333; font-weight: bold; text-decoration: none;
            }
            .ViewD a:hover{ background: #cc3333; color: #fff;}
            .allview {
                margin: 20px auto;
                width: 150px;
                text-align: center;
                padding: 18px;
                border-radius: 10px;
                background: #40c8f4;
            }
            .badge {
              white-space: normal;
              text-align: left;
              padding: 8px;
              border-radius: 5px;
            }
            .allview a{color: #fff;}

            .uline{
                text-decoration: underline;
            }
            .flo-right{
                float:right;
            }
            .color-sp{
                color:black;
            }

        </style>
        
    </head>
<body>

    <?php
       $properties_shortlists = \App\Property::where( 'heart_color' , 'red' )->get();
    ?>

    <div class="productlis">
  
<h2> Hi <?php echo e(ucwords( $mail['toname'] )); ?> <?php echo app('translator')->getFromJson('custom.propertyvisits.find'); ?>
   <span class="flo-right"><span class="color-sp">Date : <?php echo e($mail['date']); ?></span> 
</h2>

        <ul>
           <?php $__currentLoopData = $properties_shortlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shortlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $property_sub_space_types = $shortlist->property_sub_space_types;
                $property_amenities = $shortlist->property_amenities;
                $property_timings = $shortlist->property_timings;
                $cover_image = $shortlist->cover_image ?? '';
                $agents = \App\User::find($shortlist->agent_id);
              ?> 
            <li>
               <div class="imgea"> 
                <img src="<?php echo e($cover_image); ?>" alt="image">
              </div>

            <p class="badge badge-pill badge-secondary">  <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                if( $space_types ){
                $property_space_type_name = $space_types->name;
                }else{
                $property_space_type_name = '-';
                }
              ?>

              <?php echo e($space_types ? $space_types->name : '-'); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </p>
        <p class="mte">*<?php echo e($mail['no_of_seats'] ?? ''); ?> <?php echo e($mail['mail_description'] ?? ''); ?>  <?php echo app('translator')->getFromJson('custom.propertyvisits.in'); ?> <?php echo e($shortlist->property_address ?? ''); ?></p>
        
        <p> <?php echo app('translator')->getFromJson('custom.propertyvisits.near-by-landmark'); ?><br/> 
           <?php echo e($shortlist->near_by_landmark ?? ''); ?>

        </p>
               
<div class="icons">
   <?php $__currentLoopData = $shortlist->property_amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="<?php echo e($property_amenity->icon->name); ?>"> </span>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
</div>
<p> <?php echo app('translator')->getFromJson('custom.propertyvisits.amount-day-month'); ?> <br/>
  <?php $__currentLoopData = $property_sub_space_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property_sub_space_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php   
                                $space_types = \App\SpaceType::find($property_sub_space_type->space_type_id);
                                $sub_space_types = \App\SpaceType::find($property_sub_space_type->sub_space_type_id);

                            ?>      
                       <?php echo e($space_types ? $space_types->name : ''); ?> ( <?php echo e($sub_space_types ? $sub_space_types->name : ''); ?> ) :<br/>

                        <?php echo e($property_sub_space_type->price_per_day); ?> <?php echo app('translator')->getFromJson('custom.propertyvisits.day'); ?>
                        <br/>
                        <?php echo e($property_sub_space_type->price_per_month); ?> <?php echo app('translator')->getFromJson('custom.propertyvisits.month'); ?>
                        <br/>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   </p>


<div class="ViewD"><a href="<?php echo e(route('properties.show', $shortlist->slug)); ?>"> <?php echo app('translator')->getFromJson('custom.propertyvisits.viewdetails'); ?> </a> 
  
</div>
 

            </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
        </ul>


<h4><?php echo app('translator')->getFromJson('custom.propertyvisits.message'); ?></h4>

<p>
  <?php echo e($mail['mail_description'] ?? ''); ?>

</p>


<hr>
<p>
   <b class="uline"><?php echo app('translator')->getFromJson('custom.propertyvisits.contact-details'); ?></b><br/>
   <b><?php echo app('translator')->getFromJson('custom.propertyvisits.site-address'); ?> </b><?php echo e($mail['site_address']); ?><br/>
   <b><?php echo app('translator')->getFromJson('custom.propertyvisits.siteccsp'); ?> </b><?php echo e($mail['country_code']); ?>  <?php echo e($mail['site_phone']); ?><br/>
   <b><?php echo app('translator')->getFromJson('custom.propertyvisits.sited'); ?> </b><?php echo e($mail['site_email']); ?><br/>
   <a href="<?php echo e($mail['site_url'] ?? ''); ?>"><?php echo app('translator')->getFromJson('custom.propertyvisits.url'); ?></a>
</p>

    </div>

</body>
</html>