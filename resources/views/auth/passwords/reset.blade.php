<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

    
        
       <!-- App title -->
        <title>Password Reset</title>

        <!-- App css -->
         @include( 'partials.newadmin.head' )
       

    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <?php
                              $site_logo = getSetting('site_logo','site_settings');
                            ?>

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    <div class="m-t-10 m-b-10">
                                        <a href="index.html" class="text-success">
                                            <span><img src="{{IMAGE_PATH_SETTINGS.$site_logo}}" alt="" height="36"></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="account-content">
                                    <div class="text-center m-b-20">
                                        <p class="text-muted m-b-0 font-13">{{ __('Reset Password') }}  </p>
                                    </div>
                                     <form method="POST" class="form-horizontal" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group row">
                                            <div class="col-12">

                                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="@lang('custom.eforms.email')" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">

                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="@lang('custom.eforms.password')" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif

                                             
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">

                                                      <input id="password-confirm" placeholder="@lang('custom.eforms.confirm-password')" type="password" class="form-control" name="password_confirmation" required> 
                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10 row">
                                            <div class="col-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                                                        type="submit">
                                                     {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

       @include( 'partials.newadmin.javascripts' )

    </body>
</html>