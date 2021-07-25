@extends('layouts.default')

@push('styles')

@endpush
@section('page-name', 'Login')
@section('content')
<style>
    .my-account-section .u-column1, .my-account-section .u-column2{
        float: none;
        margin: 0 auto;
    }
</style>
 <!-- start my-account-section -->
 <section class="my-account-section">
    <div class="container-1410">
        <div class="row">
            <div class="col-xs-12">
                <div class="woocommerce">
                   <div class="woocommerce-notices-wrapper"></div>
                   <div class="u-columns col2-set" id="customer_login">
                      <div class="u-column1 col-1">

                        @if (session('msgType'))
                           <div id="msgDiv" class="alert alert-{{session('msgType')}} alert-styled-left alert-arrow-left alert-bordered">
                                 <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                 <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('message') }}
                           </div>
                        @endif
                        @if ($errors->any())
                           @foreach ($errors->all() as $error)
                           <div class="alert alert-danger alert-styled-left alert-bordered">
                                 <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                 <span class="text-semibold">Opps!</span> {{ $error }}.
                           </div>
                           @endforeach
                        @endif

                         <h2>Login</h2>
                         <form class="woocommerce-form woocommerce-form-login login" action="{{ route('loginAction') }}" method="post">
                           @csrf
                           <input type="hidden" name="from_web" value="yes">
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                               <label for="email">Email &nbsp;<span class="required">*</span></label>
                               <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="email" autocomplete="email" />            
                            </p>
                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                               <label for="password">Password&nbsp;<span class="required">*</span></label>
                               <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
                            </p>
                            <p class="form-row">
                                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="Log in">Log in</button>
                                <a  href="{{ route('register') }}" class="woocommerce-Button woocommerce-button button " style="background: #fcba29;">Registration Now</a>
                            </p>
                            {{-- <p class="woocommerce-form-row form-row">
                                <input type="hidden" id="woocommerce-register-nonce" name="woocommerce-register-nonce" value="2361821e0b" /><input type="hidden" name="_wp_http_referer" value="/my-account/" />             
                                <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="Register">Register</button>
                             </p> --}}
                            <p class="woocommerce-LostPassword lost_password">
                               <a href="http://proffer.themegeniuslab.com/my-account/lost-password/">Lost your password?</a>
                            </p>
                            <p class="woocommerce-LostPassword lost_password">
                               <a href="http://proffer.themegeniuslab.com/my-account/lost-password/">Lost your password?</a>
                            </p>
                         </form>
                      </div>
                   </div>
                </div>                        
            </div>
        </div>  
    </div>
</section>
<!-- end my-account-section -->

@endsection

@push('javascript') 

@endpush