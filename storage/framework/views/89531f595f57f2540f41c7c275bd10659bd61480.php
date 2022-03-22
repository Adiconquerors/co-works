<?php $request = app('Illuminate\Http\Request'); ?>

<style>
  .sty_ddn{
    display: none;
  }
</style>
<div class="filter filterto">

<div class="clearfix"></div>
<div class="container">
<div class="row">
 <div class="col-xs-12 col-lg-12">
 <h1 class="osLight"><?php echo app('translator')->getFromJson('custom.explore.filter'); ?></h1>
<p><?php echo app('translator')->getFromJson('custom.explore.space-type'); ?></p> 
<ul id="myTabs" class="nav nav-pills lidtwork" role="tablist" data-tabs="tabs">
<?php
if ( empty( $clear ) ) {
    $clear = 'no';
}
if ( empty( $wstype ) ) {
    $wstype = SPACE_TYPE_COWORKING;
}

$parents = \App\SpaceType::where('parent_id', 0)->get();

$location = $request->input('location');

foreach ($parents as $spacetype) {

    $active = '';
   if ( $wstype == $spacetype->id ) {
    $active = 'active';
   }
?>
<li class="spacetype spacetype_<?php echo e($spacetype->id); ?> <?php echo e($active); ?>">
 <a href="javascript:void(0)" onclick="fetchData('<?php echo e($location); ?>', '<?php echo e($spacetype->id); ?>')" >
<?php if($spacetype->id == 1): ?>
  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/workspace.png" > <b><?php echo e($spacetype->name); ?></b>
  <?php elseif($spacetype->id == 2): ?>
  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/meeting-space.png" > <b><?php echo e($spacetype->name); ?></b>
  <?php elseif($spacetype->id == 3): ?>
  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/virtualspace.png" > <b><?php echo e($spacetype->name); ?></b>
  <?php elseif($spacetype->id == 4): ?>
  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/workspace.png" > <b><?php echo e($spacetype->name); ?></b>
   <?php elseif($spacetype->id == 5): ?>
  <img src="<?php echo e(PUBLIC_ASSETS); ?>images/meeting-space.png" > <b><?php echo e($spacetype->name); ?></b> 

  <?php endif; ?>
</a>
</li>
<?php } ?>
</ul>
<br>
<div class="tab-content">
<!-- tab1 -->
<div role="tabpanel" class="tab-pane fade in active filtre" id="Workspace" >

 <?php
 
$parent_id = '';
$parent = \App\SpaceType::where( 'id', $wstype)->first();
if ( $parent ) {
  $parent_id = $parent->id;
}

$subtype = '';
if ( request('subtype') ) {
  $subtype = request('subtype');
}

 $children = \App\SpaceType::select(['space_types.*'])->join('space_types as s2', 's2.id', '=', 'space_types.parent_id')->get();
  foreach ( $children as $child ) {
    if ( ! empty( $excludefilters ) ) {
        $parts = explode( ',', $excludefilters);
        if ( in_array( $child->id, $parts ) ) {
            continue;
        }
    }
$display = false;

if ( ! empty( $subtype ) ) {
  if( $subtype == $child->id ) {
    $display = true;
  }
} elseif ( $parent_id == $child->parent_id ) {
  $display = true;
}

 ?>
<button class="btn btn-default filterbutton subspacetypefilterbutton subspacetype_<?php echo e($child->parent_id); ?>" type="submit" value="<?php echo e($child->id); ?>" style="display: <?php if($display): ?> inline-block <?php else: ?> none <?php endif; ?>"><?php echo e($child->name); ?>

    <span class="fa fa-close subtypefilterclear" data-subtype_id="<?php echo e($child->id); ?>" data-location="<?php echo e($location); ?>" data-wstype="<?php echo e($child->parent_id); ?>" data-filter_type="subtype"></span>
</button>
<?php } ?>



<button class="btn btn-default filterbutton sty_ddn" type="submit" value="<?php echo e($filter_available_date); ?>" ><?php echo app('translator')->getFromJson('custom.explore.avaliable'); ?> <?php echo e($filter_available_date); ?>

    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="<?php echo e($location); ?>" data-wstype="<?php echo e($wstype); ?>" data-filter_type="available_date"></span>
</button>



<button class="btn btn-default filterbutton sty_ddn" type="submit" value="<?php echo e($filter_months); ?>"><?php echo app('translator')->getFromJson('custom.explore.no-of-months'); ?> <?php echo e($filter_months); ?>

    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="<?php echo e($location); ?>" data-wstype="<?php echo e($wstype); ?>" data-filter_type="months"></span>
</button>







<button class="btn btn-default filterbutton sty_ddn" type="submit" value="<?php echo e($filter_seats); ?>" ><?php echo app('translator')->getFromJson('custom.explore.no-of-seats'); ?> <?php echo e($filter_seats); ?>

    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="<?php echo e($location); ?>" data-wstype="<?php echo e($wstype); ?>" data-filter_type="seats"></span>
</button>



<button class="btn btn-default filterbutton sty_ddn" type="submit" value="<?php echo e($price_range_start); ?>_<?php echo e($price_range_end); ?>" ><?php echo app('translator')->getFromJson('custom.explore.no-of-seats'); ?> <?php echo e($price_range_start); ?> - <?php echo e($price_range_end); ?>

    <span class="fa fa-close subtypefilterclear" data-subtype_id="" data-location="<?php echo e($location); ?>" data-wstype="<?php echo e($wstype); ?>" data-filter_type="price_range"></span>
</button>

<input type="hidden" name="excludefilters" id="excludefilters" value="">
<input type="hidden" name="location" id="location" value="<?php echo e($location); ?>">
<input type="hidden" name="wstype" id="wstype" value="<?php echo e($wstype); ?>">
<input type="hidden" name="subtype_id" id="subtype_id" value="<?php echo e($subtype); ?>">
<input type="hidden" name="datasource" id="datasource" value="<?php echo e(route('properties.list')); ?>">

<button class="btn btn-danger clearFilters sty_ddn" data-location="<?php echo e($location); ?>" data-wstype="<?php echo e($wstype); ?>"  type="submit"><?php echo app('translator')->getFromJson('custom.explore.clear'); ?>
<span class="fa fa-trash-o"></span>
</button>


 <!-- More filters tab1 -->
<div class="filter" id="morefiltersDiv">
<h1 class="osLight">
<button class="btn btn-info handleFilter" type="submit" ><b><?php echo app('translator')->getFromJson('custom.explore.more-filters'); ?></b>
<span class="fa fa-filter"></span>
</button>
</h1>

<div class="clearfix"></div>
<form class="filterForm">

<div class="row">
<!-- Availability -->
<label>
<b><?php echo app('translator')->getFromJson('custom.explore.avaliability'); ?></b>
</label><br>
            <div class='col-sm-3'>
              <div class="form-group">
                <label><b><?php echo app('translator')->getFromJson('custom.explore.date'); ?></b></label>
                <div class='input-group date' id='datepicker'>
                  <input type='text' class="form-control" id="filter_available_date" value="<?php echo e($filter_available_date); ?>" />
                  <span class="input-group-addon">
                 <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </div>

           
             <!-- datepicker -->
            <div class='col-sm-2'>
            <div class="form-group">
                <label><b><?php echo app('translator')->getFromJson('custom.explore.no-of-months'); ?></b></label>
                <input type="number" min="1" class="form-control" id="filter_months" value="<?php echo e($filter_months); ?>">
            </div>
            </div>
            <div class='col-sm-2'>
            <div class="form-group">
                <label><b><?php echo app('translator')->getFromJson('custom.explore.no-of-seats'); ?></b></label>
                <input type="number" min="1"class="form-control" id="filter_seats" value="<?php echo e($filter_seats); ?>">
            </div>
            </div>
<!-- /Availability -->

</div>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 formItem">
<div class="formField">
    <label><b><?php echo app('translator')->getFromJson('custom.explore.price-range'); ?></b></label>
    <div class="slider priceSlider">
        <div class="sliderTooltip">
            <div class="stArrow"></div>
            <div class="stLabel"></div>
        </div>
    </div>
    <input type="hidden" name="price_rang_start" id="price_range_start" value="<?php echo e($price_range_start); ?>">
    <input type="hidden" name="price_rang_end" id="price_range_end" value="<?php echo e($price_range_end); ?>">
</div>
</div>
</div>

<div class="sduiv3-filter-button-affixed">
        <a href="#" class="btn btn-info handleFilterClose"><?php echo app('translator')->getFromJson('custom.explore.show-spaces'); ?></a>
    </div>

</form>
</div>
<!-- /More filters -->
</div>
<!-- /tab1 -->

</div>
</div>
</div>
</div>
</div>
