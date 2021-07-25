@extends('layouts.default')
@section('page-name', isset($category_name) ? $category_name : 'Search Result')
@push('styles')
    <style>
        .selected{
            color: #305f90 !important;
        }
        .shop-section .products > li{
            width: calc(25% - 30px) !important;
        }
    </style>
@endpush

@section('content')
<!-- start shop-section -->
<section class="shop-section section-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-xs-12">
                <div class="shop-area clearfix">
                    <div class="">
                        <div class="woocommerce-content-inner">
                            {{-- SHOP SEARCH AND SORTING SECTION START--}}
                            <div class="woocommerce-toolbar-top">
                                <p class="woocommerce-result-count">Showing 1–12 of {{count($books)}} results</p>
                                <a href="{{ route('home') }}" class="">
                                    Back To Home
                                </a>
                            </div>
                            {{-- SHOP SEARCH AND SORTING SECTION END--}}
                            {{-- PRODUCT LIST START --}}
                            @if (count($books)>0)
                            <ul class="products">
                                @foreach ($books as $book)
                                    <li class="product">
                                        <div class="product-holder">
                                            <a href="{{ route('bookSingle', [$book->id]) }}"><img src="{{asset("uploads/book/".$book->book_thumb)}}" alt></a>
                                            <div class="shop-action-wrap">
                                                <ul class="shop-action">
                                                    <li><a href="#"  title="Quick view!"><i class="fi flaticon-view"></i></a></li>
                                                    {{-- <li><a href="#" title="Add to Wishlist!"><i class="fi icon-heart-shape-outline"></i></a></li> --}}
                                                    <li><a title="Add to cart!" onclick="addToCart({{$book->id}})" style="cursor: pointer;"><i class="fi flaticon-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h4><a href="{{ route('bookSingle', [$book->id]) }}">{{$book->title}}</a></h4>
                                            <p class="product-description">{{Str::words(strip_tags($book->summery), 50)}} </p>
                                        </div>
    
                                        <div class="quick-view-single-product">
                                            <div class="view-single-product-inner clearfix">
                                                <button class="btn quick-view-single-product-close-btn"><i class="pe-7s-close-circle"></i></button>
                                                <div class="img-holder">
                                                    <img src="{{asset("uploads/book/".$book->book_thumb)}}" alt>
                                                </div>
                                                <div class="product-details">
                                                    <h4>{{$book->title}}</h4>
                                                    <div class="rating">
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star-social-favorite-middle-full"></i>
                                                        <span>(2 Customer review)</span>
                                                    </div>
                                                    <p>{{Str::words(strip_tags($book->summery), 50)}}</p>
                                                    <div class="product-option">
                                                        {{-- <form class="form" id="add-to-cart-form">
                                                            <input type="hidden" name="bood_id" value="{{ $book->id }}">
                                                        </form> --}}
                                                        <div class="addToCartDiv">
                                                            <button type="button" onclick="addToCart({{$book->id}})" >Add to cart</button>
                                                        </div>
                                                        {{-- <div class="loader" >
                                                            <img src="{{ asset('public/web/images/ajax-loader.gif') }}" alt="">
                                                        </div> --}}
                                                    </div> 
                                                    <div class="thb-product-meta-before">
                                                        <div class="product_meta">
                                                            <span class="posted_in">Author: 
                                                                <a href="#">{{$book->author_name}}</a>
                                                            </span>
                                                            <span class="posted_in">Categories: 
                                                                <a href="#">{{$book->category_name}}</a>
                                                            </span>
                                                            <span class="posted_in">Language: 
                                                                <a href="#">{{$book->language_name}}</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end quick-view-single-product -->
                                    </li>
                                @endforeach
                            </ul>
                            @else
                                <p>No Book Found</p>
                            @endif
                                
                            {{-- PRODUCT LIST END --}}
                        </div>
                        {{ $books->links('web.paginate') }}
                    </div>
                </div>
            </div>
        </div>                  
    </div> <!-- end container -->
</section>
<!-- end shop-section -->
@endsection

@push('javascript') 

@endpush
