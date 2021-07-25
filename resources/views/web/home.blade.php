@extends('layouts.default')
@section('page-name', 'Home')
@push('styles')
    <style>
        .selected{
            color: #305f90 !important;
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
                    <div class="woocommerce-content-wrap">
                        <div class="woocommerce-content-inner">
                            {{-- SHOP SEARCH AND SORTING SECTION START--}}
                            <div class="woocommerce-toolbar-top">
                                <p class="woocommerce-result-count">Choose your books</p>
                                <div class="products-sizes">
                                    <a href="#" class="grid-4 active">
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <a href="#" class="grid-3">
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                    <a href="#" class="list-view">
                                        <div class="grid-draw-line">
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw-line">
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="grid-draw-line">
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </a>
                                </div>
                                {{-- <form class="woocommerce-ordering" method="get">
                                    <select name="orderby" class="orderby">
                                         <option value="menu_order" selected='selected'>Default sorting</option>
                                        <option value="popularity">Sort by popularity</option>
                                        <option value="rating">Sort by average rating</option>
                                        <option value="date">Sort by newness</option>
                                        <option value="price">Sort by price: low to high</option>
                                        <option value="price-desc">Sort by price: high to low</option>
                                    </select>
                                    <input type="hidden" name="post_type" value="product" />                    
                                </form>                             --}}
                            </div>
                            {{-- SHOP SEARCH AND SORTING SECTION END--}}
                            {{-- PRODUCT LIST START --}}
                            @if (count($mainCategories)>0)
                            @foreach ($mainCategories as $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">{{$category->name}}</div>
                                <div class="panel-body">
                                    @if (count($category->books)>0)
                                    <ul class="products">
                                        @foreach ($category->books as $book)
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
                                    <a href="{{ route('booksByCategory', [$category->id]) }}" class="pull-right">View All</a>
                                    @else
                                        <p>No Book Found</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            @endif
                            {{-- PRODUCT LIST END --}}
                        </div>
                        {{-- {{ $books->links('web.paginate') }} --}}
                    </div>
                    {{-- SIDEBAR START --}}
                    <div class="shop-sidebar">
                        <div class="widget widget_search">
                            <div class="search-widget">
                               <form class="searchform" action="{{ route('booksByCategory', [0]) }}" method="GET">
                                    <div>
                                        <input type="text" name="search" placeholder="Search By Book">
                                        <button type="submit"><i class="ti-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>  

                        <div class="widget woocommerce widget_product_categories">
                            <h3>Filter by categories</h3>
                            <ul class="product-categories">
                                <li class="cat-item">
                                    <a href="{{ route('home') }}" class="{{empty($category_id) ? 'selected' : ''}}">All</a>
                                </li>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                    <li class="cat-item">
                                        <a href="{{ route('home', ['category_id'=>$category->id]) }}" class="{{@$category_id == $category->id ? 'selected' : ''}}">{{$category->name}}</a>
                                    </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                    </div>
                    {{-- SIDEBAR END --}}
                </div>
            </div>
        </div>                  
    </div> <!-- end container -->
</section>
<!-- end shop-section -->
@endsection

@push('javascript') 

@endpush
