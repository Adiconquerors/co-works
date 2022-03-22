<style>
  .sty-z{
    z-index: 9999;
  }
  .sty-f20{
    font-size: 20px;
  }
</style>
<div class='col-md-12'>
      <!--preview panel-->
      <div class="w3-container w3-center ">
         <div class="w3-row w3-card-4 w3-grey w3-round-large w3-border comparePanle w3-margin-top ">
            <div class="w3-row ">
               <div class="w3-col l9 m8 s6 ">
                  <h4><b>@lang('custom.compare.products')</b></h4>
               </div>
               <div class="w3-col l3 m4 s6 w3-margin-top ">

                  <button class="w3-btn w3-round-small w3-white w3-border notActive cmprBtn " disabled title="Compare Properties "><b>@lang('custom.compare.compare')</b></button>
                  <a href="javascript:void(0);" class="close-box-btn "></a>
               </div>
            </div>
            <div class=" titleMargin w3-container comparePan ">
            </div>
         </div>
      </div>
      <!--end of preview panel-->
      <!-- comparision popup-->
      <div id="id01" class="w3-animate-zoom w3-white w3-modal modPos sty-z">
         <div class="w3-container ">
            <a onclick="document.getElementById( 'id01').style.display='none' " class="whiteFont w3-padding w3-closebtn closeBtn ">×</a>
         </div>
         <div class="w3-row contentPop w3-margin-top ">
         </div>
      </div>
      <!--end of comparision popup-->
      <!--  warning model  -->
      <div id="WarningModal " class="w3-modal ">
         <div class="w3-modal-content warningModal ">
            <header class="w3-container w3-teal ">
               <h3 class="sty-f20"><span>⚠</span> &nbsp;@lang('custom.compare.error')</h3>
            </header>
            <div class="w3-container ">
               <h4>@lang('custom.compare.max-three')</h4>
            </div>
            <footer class="w3-container w3-right-align ">
               <button id="warningModalClose " onclick="document.getElementById( 'id01').style.display='none' " class="w3-btn w3-hexagonBlue w3-margin-bottom ">@lang('custom.compare.ok')</button>
            </footer>
         </div>
      </div>
   </div>

    <script>

jQuery(document).ready(function() {
  "use strict";

     jQuery('.close-box-btn').on('click', function () {
           jQuery('.titleMargin').css('display','none');
           jQuery('.w3-container').css('display','none');
           jQuery('.comparePan').css('display','none');
           location.reload();
       });
   });


</script>



