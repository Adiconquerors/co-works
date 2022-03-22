<style>
    .sty-dn{
        display:none;
    }
    .blog-mrg{
        margin: 5px 0px 15px 14px !important;
    }
    input {
   border: 1px solid #c4c4c4;
   border-radius: 5px;
   background-color: #fff;
   padding: 3px 5px;
   width: auto;
}
.sty-p10{
    padding:5px !important;
}
input[type="file"]:focus, input[type="radio"]:focus, input[type="checkbox"]:focus {
   outline: none;}
</style>
<div class="modal fade" id="blog-signin" role="dialog" aria-labelledby="signinLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <button type="button" class="close sty-p10" data-dismiss="modal" id="close-button-two" aria-hidden="true">×</button>

                <div class="alert alert-danger print-error-msg-signup sty-dn">
                <ul></ul>
                </div>
                <div class="modal-header">
                    <h4 class="modal-title" id="signinLabel">@lang('global.signin')</h4>
                </div>
                <div class="modal-body">

                <div class="alert alert-danger print-error-msg-login sty-dn" >
                <ul></ul>
                </div>

                    <form role="form"
                            method="POST" 
                            action="{{ url('login_test') }}"
                            id="blogFormLogin"
                        >
                        @csrf 
                        <div class="form-group">
                            <input type="text" id="blog-login-email" class="form-control {{ $errors->has('login-email') ? ' is-invalid' : '' }}" type="email" name="login-email" value="{{ old('login-email') }}" placeholder="@lang('custom.eforms.email')">
                        </div>

                        @if ($errors->has('login-email'))
                        <span class="cd-error-message" role="alert">
                        {{ $errors->first('login-email') }}
                        </span>
                        @endif



                        <div class="form-group">
                            <input type="password"  placeholder="Password" name="login-password"  id="blog-login-password" class="form-control {{ $errors->has('login-password') ? ' is-invalid' : '' }}"  type="password" name="login-password" placeholder="@lang('custom.eforms.password')">
                        </div>

                        @if ($errors->has('login-password'))
                        <span class="cd-error-message" role="alert">
                        <strong>{{ $errors->first('login-password') }}</strong>
                        </span>
                        @endif

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox" id="remember {{ old('remember') ? 'checked' : '' }}" name="remember" checked><span class="fa fa-check"></span> @lang('global.remenberme')</label></div>
                                    <input type="hidden" id="redirect_url" name="redirect_url" value="">
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">

                        {!! Form::submit('Login', ['class' => 'btn btn-lg btn-green isThemeBtn', 'id' => 'btn-blog-login-submit']) !!}

                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

      <div class="modal fade" id="blog-signup" role="dialog" aria-labelledby="signupLabel" aria-hidden="true">

        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <button type="button" class="close sty-p10" data-dismiss="modal" id="close-button-one" aria-hidden="true">×</button>

                <div class="modal-header">
                    <h4 class="modal-title" id="signupLabel">@lang('global.signup')</h4>
                </div>


                <div class="modal-body">

                    <form role="form"
                        method="POST" 
                        action="{{ url( 'register_test' ) }}"
                        id="blogFormRegister"
                      >
                      @csrf

                    <div class="alert alert-danger print-error-msg-signup sty-dn">
                    <ul></ul>
                    </div>
                    
                    <input type="radio" name="sign_up_as" id="sign_up_landlord" value="2" class="blog-mrg">&nbsp;<label for="sign_up_landlord" class="font-display">@lang('global.landlord')</label>
                    
                         
                     <input type="radio" name="sign_up_as" id="sign_up_customer" class="blog-mrg" value="3" checked>&nbsp;<label for="sign_up_customer" class="font-display">@lang('global.customer')</label>
                    

                <div class="form-group">
                    <input type="text"  id="blog-signup-name" name="name" placeholder="Name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"   minlength="2" value="{{ old('name') }}" placeholder="@lang('custom.eforms.name')" autofocus>
                </div>
                       
                @if ($errors->has('name'))
                <span class="cd-error-message" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif

                <div class="form-group">
                <input class="form-control {{ $errors->has('blog-email') ? ' is-invalid' : '' }}" id="blog-sign-up-email" name="sign-up-email" type="email" value="{{ old('sign-up-email') }}" placeholder="@lang('custom.eforms.email')">

                @if ($errors->has('sign-up-email'))
                <span class="cd-error-message" role="alert">
                <strong>{{ $errors->first('sign-up-email') }}</strong>
                </span>
                @endif
                </div>

                    <?php
                     $currencies = \App\Currency::where('status','Active')->get(); 
                    ?>
                    <div class="form-group">
                   <select class="form-control" id="currency_id" name="currency_id"  value="">
                       <option value="" disabled selected>@lang('global.select-currency')</option>
                        @foreach($currencies as $currency )
                          <option value="{{$currency->id}}">{{$currency->name}}</option>
                        @endforeach
                      </select>
                  </div>

                    <div class="form-group">
                    <input type="number" placeholder="Mobile" class="form-control {{ $errors->has('blog-mobile') ? ' is-invalid' : '' }}" id="blog-mobile" value="{{ old('mobile') }}" min="1" maxlength="10" name="mobile" placeholder="@lang('custom.eforms.mobile')">

                    @if ($errors->has('blog-mobile'))
                    <span class="cd-error-message" role="alert">
                    <strong>{{ $errors->first('blog-mobile') }}</strong>
                    </span>
                    @endif

                    </div>

                        <div class="form-group">
                            <input id="blog-signup-password" type="password" name="signup-password" placeholder="@lang('custom.eforms.password')" class="form-control">
                        </div>
                        
                        @if ($errors->has('signup-password'))
                        <span class="cd-error-message" role="alert">
                        <strong>{{ $errors->first('signup-password') }}</strong>
                        </span>
                        @endif

                        <div class="form-group">
                            <div class="btn-group">

                                <input class="btn btn-lg btn-green isThemeBtn" type="submit" value="Sign Up"  id="btn-blog-signup-submit">

                            </div>
                        </div>

                      
                    </form>
                </div>
            </div>
        </div>
    </div>

   

<script src="{{ PUBLIC_ASSETS }}js/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    "use strict";
    $(document).on('submit', '#blogFormLogin', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        
        var _token   = $("input[name='_token']").val();
        var email    = $("#blog-login-email").val();
        var password = $("#blog-login-password").val();
        
        $.ajax({
            url: "{{route('login_test')}}",
            type:'POST',
            data: {_token:_token, email:email, password:password},
            success: function(data) {
                if($.isEmptyObject(data.error)){
                     if ( $('#redirect_url').val() != '') {
                          window.location = $('#redirect_url').val();
                        }else {
                          window.location = '{{route("blog")}}';
                        } 
                    
                   
                }else{
                    printErrorMsg(data.error, 'print-error-msg-login');
                }
            }
        });
    }); 

    $(document).on('submit', '#blogFormRegister', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var _token   = $("input[name='_token']").val();
        var name    = $("#blog-signup-name").val();
        var email    = $("#blog-sign-up-email").val();
        var mobile = $("#blog-mobile").val();
        var currency_id = $("#currency_id").val();
        var sign_in_as = $("input[name='sign_up_as']:checked"). val();
        var password = $("#blog-signup-password").val();
        
        $.ajax({
            url: "{{route('register_test')}}",
            type:'POST',
            data: {_token:_token, name:name, email:email, mobile:mobile, password:password, currency_id:currency_id, sign_in_as:sign_in_as},
            success: function(data) {
                if($.isEmptyObject(data.error)){
                   
                    if ( $('#redirect_url').val() != '') {
                          window.location = $('#redirect_url').val();
                        }else {
                          window.location = '{{route("blog")}}';
                        } 
                   
                }else{
                    printErrorMsg(data.error, 'print-error-msg-signup');
                }
            }
        });
    }); 

    function printErrorMsg (msg, divclass) {
        
        $(".print-error-msg-login").css("display", 'none');
        $(".print-error-msg-signup").css("display", 'none');

        $("." + divclass).find("ul").html('');
        $("." + divclass).css('display','block');
        $.each( msg, function( key, value ) {
            $("." + divclass).find("ul").append('<li>'+value+'</li>');
        });
    }
});


</script>

