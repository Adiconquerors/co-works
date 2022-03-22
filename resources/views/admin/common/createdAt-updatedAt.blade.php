<?php 
  $created_date     =  $record->created_at;
  $dateCreatedTime = new DateTime('now', new DateTimeZone('Asia/Kolkata')); 
  $createdTime =  $dateCreatedTime->format("d/m/y  H:i A");

  $updated_date = $record->updated_at;
  $dateupdatedTime = new DateTime('now', new DateTimeZone('Asia/Kolkata')); 
  $updatedTime = $dateupdatedTime->format("d/m/y  H:i A"); 
?>




<div class="post-title">
   <h5>@lang('global.created_at')</h5>
       </div>
    <div>   
    <p>{{ $createdTime  }}</p>
 </div> 

 <div class="post-title">
    <h5>@lang('global.updated_at')</h5>
 </div>
 <div>
    <p>{{ $updatedTime }}</p>
 </div> 

