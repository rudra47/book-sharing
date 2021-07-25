@extends('layouts.default')

@push('styles')

@endpush
@section('page-name', 'Registration')
@section('content')
<style>
    .checkout-section .checkout.woocommerce-checkout .col2-set{
        padding: 0px !important; 
        margin: 0 auto; float: none;
    }
</style>
<!-- start checkout-section -->
<section class="checkout-section section-padding">
    <div class="container-1410">
        <div class="row">
            <div class="col col-xs-12">
                <div class="woocommerce">
                    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{route('registerAction')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="col2-set" id="customer_details">
                            <div class="col-1">
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

                                <div class="woocommerce-billing-fields">

                                    <h3>Registration Now</h3>

                                    <p class="form-row form-row form-row-first validate-required" id="first_name_field">
                                        <label for="first_name" class="">First Name <abbr class="required" title="required">*</abbr></label>
                                        <input  type="text" class="input-text " name="first_name" id="first_name" placeholder="" autocomplete="given-name" value="" />
                                    </p>

                                    <p class="form-row form-row form-row-last validate-required" id="last_name_field">
                                        <label for="last_name" class="">Last Name <abbr class="required" title="required">*</abbr></label>
                                        <input required type="text" class="input-text " name="last_name" id="last_name" placeholder="" autocomplete="family-name" value="" />
                                    </p>
                                    <div class="clear"></div>

                                    <p class="form-row form-row form-row-first validate-required validate-email" id="email_field">
                                        <label for="email" class="">Email Address <abbr class="required" title="required">*</abbr></label>
                                        <input required type="email" class="input-text " name="email" id="email" placeholder="" autocomplete="email" value="" />
                                    </p>

                                    <p class="form-row form-row form-row-last validate-required validate-phone" id="phone_field">
                                        <label for="phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                        <input required type="tel" class="input-text " name="phone" id="phone" placeholder="" autocomplete="tel" value="" />
                                    </p>
                                    <div class="clear"></div>

                                    <p class="form-row form-row form-row-wide address-field validate-required" id="address_1_field">
                                        <label for="address_1" class="">Address <abbr class="required" title="required">*</abbr></label>
                                        <input required type="text" class="input-text " name="address" id="address_1" placeholder="Street address" autocomplete="address-line1" value="" />
                                    </p>

                                    <div class="clear"></div>
                                    
                                    <p class="form-row form-row validate-required" id="account_password_field">
                                        <label for="account_password" class="">Account password <abbr class="required" title="required">*</abbr></label>
                                        <input required type="password" class="input-text " name="password" id="account_password" placeholder="Password" value="" />
                                    </p>

                                    <p class="form-row form-row-wide create-account">
                                        <input required type="submit" class="button alt" id="place_order" value="Register" data-value="Register">
                                    </p>

                                    <div class="clear"></div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end checkout-section -->

@endsection

@push('javascript') 

@endpush