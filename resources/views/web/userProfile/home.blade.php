@extends('layouts.default')

@push('styles')
    <style>
        .course-items {
            display: flex; 
            justify-content: center;
        }
    
        /* Video Slider */
        .carousel-inner { margin: auto; width: 90%; }
        .carousel-control { width:  4%; }
        .carousel-control.left,
        .carousel-control.right {
          background-image:none;
        }
         
        .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right {
          margin-top:-10px;
          margin-left: -10px;
          color: #444;
        }
        .ytMobileDot {
                visibility: hidden;
                opacity: 0;
        }
        @media (max-width: 767px) {
            .yt-control {
                visibility: hidden;
                opacity: 0;
            }
            .ytMobileDot {
                visibility: visible;
                opacity: 1;
            }
            .course-items {
                display: contents; 
            }
        }
        
        /* @media (max-width: 767px) {
          .carousel-inner > .item.next,
          .carousel-inner > .item.active.right {
              left: 0;
              -webkit-transform: translate3d(100%, 0, 0);
              transform: translate3d(100%, 0, 0);
          }
          .carousel-inner > .item.prev,
          .carousel-inner > .item.active.left {
              left: 0;
              -webkit-transform: translate3d(-100%, 0, 0);
              transform: translate3d(-100%, 0, 0);
          }
        
        }
        @media (min-width: 767px) and (max-width: 992px ) { 
          .carousel-inner > .item.next,
          .carousel-inner > .item.active.right {
              left: 0;
              -webkit-transform: translate3d(50%, 0, 0);
              transform: translate3d(50%, 0, 0);
          }
          .carousel-inner > .item.prev,
          .carousel-inner > .item.active.left {
              left: 0;
              -webkit-transform: translate3d(-50%, 0, 0);
              transform: translate3d(-50%, 0, 0);
          }
        }
        @media (min-width: 992px ) {
          
          .carousel-inner > .item.next,
          .carousel-inner > .item.active.right {
              left: 0;
              -webkit-transform: translate3d(16.7%, 0, 0);
              transform: translate3d(16.7%, 0, 0);
          }
          .carousel-inner > .item.prev,
          .carousel-inner > .item.active.left {
              left: 0;
              -webkit-transform: translate3d(-16.7%, 0, 0);
              transform: translate3d(-16.7%, 0, 0);
          }
          
        } */
        
        .youtube {
            background-color: #000;
            margin-bottom: 30px;
            position: relative;
            padding-top: 56.25%;
            overflow: hidden;
            cursor: pointer;
        }
        .youtube img {
            width: 100%;
            top: -16.84%;
            left: 0;
            opacity: 0.7;
        }
        .youtube .play-button {
            width: 90px;
            height: 60px;
            background-color: #333;
            box-shadow: 0 0 30px rgba( 0,0,0,0.6 );
            z-index: 1;
            opacity: 0.8;
            border-radius: 6px;
        }
        .youtube .play-button:before {
            content: "";
            border-style: solid;
            border-width: 15px 0 15px 26.0px;
            border-color: transparent transparent transparent #fff;
        }
        .youtube img,
        .youtube .play-button {
            cursor: pointer;
        }
        .youtube img,
        .youtube iframe,
        .youtube .play-button,
        .youtube .play-button:before {
            position: absolute;
        }
        .youtube .play-button,
        .youtube .play-button:before {
            top: 50%;
            left: 50%;
            transform: translate3d( -50%, -50%, 0 );
        }
        .youtube iframe {
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
        }
    </style>
@endpush

@section('content')
<!--Konnect Slider -->
<div class='konnect-carousel carousel-image carousel-image-pagination carousel-image-arrows flexslider'>
    <ul class='slides'>
    <!--Slider One-->
    <li class='item'>
        <div class='container'>
        <div class='row pos-rel'>
            <div class='col-sm-12 col-md-6 animate'>
            <h1 class='big fadeInDownBig animated'>@lang('default.online-and-classroom-training')</h1>
            <p class='normal fadeInUpBig animated delay-point-five-s'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in tincidunt mauris. Etiam arcu enim, laoreet vitae orci vel, rutrum feugiat nibh. Integer feugiat ligula tellus, non pulvinar justo pharetra eu. Nullam vehicula lorem ut diam tincidunt sagittis. Morbi est ligula, posuere in laoreet ac, porta porttitor dui</p>
            <a class='btn btn-bordered btn-white btn-lg fadeInRightBig animated delay-one-s' href='#'> @lang('default.show-more') </a> </div>
            <div class='col-md-6 animate pos-sta hidden-xs hidden-sm'> <img class="img-responsive img-right fadeInUpBig animated delay-one-point-five-s" alt="iPhone" src="{{ asset('web/img/slider/student-1.png') }}" /> </div>
        </div>
        </div>
    </li>
    
    <!--Slider Two-->
    <li class='item'>
        <div class='container'>
        <div class='row pos-rel'>
            <div class='col-md-6 animate pos-sta hidden-xs hidden-sm'> <img class="img-responsive img-left fadeInUpBig animated" alt="Circle" src="{{ asset('web/img/slider/student-2.png') }}" /> </div>
            <div class='col-sm-12 col-md-6 animate'>
            <h2 class='big fadeInUpBig animated delay-point-five-s'>@lang('default.who-we-are') </h2>
            <p class='normal fadeInDownBig animated delay-one-s'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in tincidunt mauris. Etiam arcu enim, laoreet vitae orci vel, rutrum feugiat nibh. Integer feugiat ligula tellus, non pulvinar justo pharetra eu. Nullam vehicula lorem ut diam tincidunt sagittis. Morbi est ligula, posuere in laoreet ac, porta porttitor dui</p>
            <a class='btn btn-bordered btn-white btn-lg fadeInLeftBig animated delay-one-point-five-s' href='#'> @lang('default.show-more') </a> </div>
        </div>
        </div>
    </li>
    
    <!--Slider Three-->
    <li class='item'>
        <div class='container'>
        <div class='row pos-rel'>
            <div class='col-sm-12 col-md-6 animate'>
            <h2 class='big fadeInLeftBig animated'>Clean and Flat</h2>
            <p class='normal fadeInRightBig animated delay-point-five-s'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in tincidunt mauris. Etiam arcu enim, laoreet vitae orci vel, rutrum feugiat nibh. Integer feugiat ligula tellus, non pulvinar justo pharetra eu. Nullam vehicula lorem ut diam tincidunt sagittis. Morbi est ligula, posuere in laoreet ac, porta porttitor dui</p>
            <a class='btn btn-bordered btn-white btn-lg fadeInUpBig animated delay-one-s' href='#'> @lang('default.show-more') </a> </div>
            <div class='col-md-6 animate pos-sta hidden-xs hidden-sm'> <img class="img-responsive img-right fadeInUpBig animated delay-one-point-five-s" alt="Man" src="{{ asset('web/img/slider/student-3.png') }}" /> </div>
        </div>
        </div>
    </li>
    </ul>
</div>
<!--/. Konnect Slider --> 

<!-- Banner Box -->
<div class="container banner">
    <div class="row course-items">
        <div class="col-sm-4">
            <div class="banner-bar"> <img src="{{ asset('web/img/icons/classroom.png') }}" alt="icon">
            <h3><span>IELTS Academic</span></h3>
            <p>Curabitur ut est a mi fermentum tristique. Aliquam et ante odio. Donec elementum odio eget ex porta, vel laoreet nisl fermentum.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="banner-bar"> <img src="{{ asset('web/img/icons/certificate.png') }}" alt="icon">
            <h3><span>IELTS General</span></h3>
            <p>Curabitur ut est a mi fermentum tristique. Aliquam et ante odio. Donec elementum odio eget ex porta, vel laoreet nisl fermentum.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="banner-bar"> <img src="{{ asset('web/img/icons/job-support.png') }}" alt="icon">
            <h3><span>English Skills</span></h3>
            <p>Curabitur ut est a mi fermentum tristique. Aliquam et ante odio. Donec elementum odio eget ex porta, vel laoreet nisl fermentum.</p>
            </div>
        </div>
    </div>
    <div class="row course-items" style="margin-top: 15px;">
        <div class="col-sm-4">
            <div class="banner-bar"> <img src="{{ asset('web/img/icons/job-support.png') }}" alt="icon">
            <h3><span>Cambrigde English</span></h3>
            <p>Curabitur ut est a mi fermentum tristique. Aliquam et ante odio. Donec elementum odio eget ex porta, vel laoreet nisl fermentum.</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="banner-bar"> <img src="{{ asset('web/img/icons/job-support.png') }}" alt="icon">
            <h3><span>IGCSE English</span></h3>
            <p>Curabitur ut est a mi fermentum tristique. Aliquam et ante odio. Donec elementum odio eget ex porta, vel laoreet nisl fermentum.</p>
            </div>
        </div>
    </div>
</div>

<!-- Live Classes -->
<section>
    <div class="container">
    <div class="row">
        <div class="col-md-12"> 
        <!--Services Heading-->
        <h2 class="section-heading">@lang('default.live-class-schedules')</h2>
        <p>@lang('default.sign-up-for-free-access')</p>
        <div class="template-space"></div>
        </div>
        <div class="live-class">
            <div class="col-md-12 live-class-menu">
                <ul>
                    <li><a href="#" class="liveMenuActive">All Exams</a></li>
                    <li><a href="#">IELTS Academic</a></li>
                    <li><a href="#">IELTS General</a></li>
                    <li><a href="#">English Skills</a></li>
                    <li><a href="#">Cambrigde English</a></li>
                    <li><a href="#">IGCSE English</a></li>
                </ul>
            </div>
            <div class="col-md-12 live-class-data">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Type</th>
                            <th>Day</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                        <tr>
                            <td>IELTS Academic</td>
                            <td>Sample</td>
                            <td>Monday</td>
                            <td>14:00 (2pm)(AEDT)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Company profile -->
<section>
    {{-- <div class="container"> --}}
        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('uploads/workflows/'.$work_flow->image_name)}}" alt="WorkFlow" width="100%">
            </div>
        </div>
    {{-- </div> --}}
</section>

<!-- Company profile -->
<section>
    <div class="container">
    <div class="row">
        <div class="col-md-12"> 
        <!--Services Heading-->
        <h2 class="section-heading">@lang('default.why-choose-us')</h2>
        <div class="template-space"></div>
        </div>
        <div class="col-md-6">
        <h2 class="para-heading">@lang('default.our-secrets')</h2>
        <p>Curabitur ut est a mi fermentum tristique. Aliquam et ante odio. Donec elementum odio eget ex porta, vel laoreet nisl fermentum. Nam risus purus, hendrerit id placerat sit amet, tempor a urna. Maecenas id quam et dolor facilisis pulvinar.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
        <a class="service-box-button">@lang('default.view-more')</a> </div>
        <div class="col-md-6"> <img src="{{ asset('web/img/students.jpg') }}" class="img-responsive img-hide-sm" alt="Company"> </div>
    </div>
    </div>
</section>

<!-- Recent Videos-->
<section class="light-bg">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="section-heading">@lang('default.recent-videos')</h2>
            <div class="template-space"></div>
        </div>
        {{-- <div class="company-stats">
            @foreach ($recent_videos as $video)
            <div class="col-md-3 col-sm-6">
                <iframe src="https://www.youtube.com/embed/{{$video->video_id}}" width="100%" frameborder="0" allow="clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
            </div>
            @endforeach
        </div> --}}
        
        <div class="carousel slide ytCarouselSlide" data-ride="carousel" data-type="multi" data-interval="3000" id="ytCarousel">
            <div class="carousel-inner">
                @foreach ($recent_videos as $key => $video)
                <div class="item @if($key == 1) active @endif">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="youtube" data-embed="{{$video->video_id}}"> 
                            <div class="play-button"></div> 
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
              <a class="left carousel-control yt-control" href="#ytCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
              <a class="right carousel-control yt-control" href="#ytCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
              <ol class="carousel-indicators ytMobileDot">
                    @foreach ($recent_videos as $key => $video)
                    <li data-target="#ytCarousel" data-slide-to="{{$key}}" @if($key == 0)class="active"@endif></li>
                    @endforeach
                </ol>
        </div>
        
    </div>
    </div>
</section>

<!--Testmonials -->
<aside class="dark-bg">
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-white">
        <h2 class="section-heading text-white">@lang('default.students-reviews')</h2>
        <div class="template-space"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" data-wow-delay="0.2s">
            <div class="carousel slide" data-ride="carousel" id="quote-carousel"> 
                <!-- Carousel Slides / Quotes -->
                <div class="carousel-inner text-center"> 
                <!--Testmonial One active-->
                    @foreach ($student_reviews as $key => $review)
                    <div class="item @if($key == 0)active @endif">
                        <blockquote>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 col-xs-12">
                            <p>{{$review->review}}</p>
                            <small>{{$review->student_name}}</small> </div>
                        </div>
                        </blockquote>
                    </div>
                    @endforeach
                </div>
                
                <!-- Carousel Buttons Next/Prev --> 
                <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-angle-left"></i></a> <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-angle-right"></i></a> 
                <!-- Bottom Carousel Indicators -->
                <ol class="carousel-indicators">
                    @foreach ($student_reviews as $key => $review)
                    <li data-target="#quote-carousel" data-slide-to="{{$key}}" @if($key == 0)class="active"@endif></li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    </div>
</aside>

<!-- Gallery Box-->
<section class="template-news">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <h2 class="section-heading text-dark">@lang('default.gallery')</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec neque erat, ultrices cursus nisi at, hendrerit tristique.</p>
        <div class="template-space"></div>
        </div>
    </div>
    <div class="row"> 
        @foreach ($galleries_photos as $key => $photo)
        <!--Gallery image-->
        <div class="col-sm-3 gallery-box"> <a href="#" data-toggle="modal" data-target=".pop-up-{{$key}}"> <img src="{{ asset('uploads/photoGallery/'.$photo->image_name) }}" class="img-responsive center-block" alt=""> </a> </div>
        <!--Gallery image-->
        @endforeach
        <div class="col-md-12 text-center margin-10"> <a class="service-box-button">View More Gallery</a> </div>
        
        <!--  Modal content one-->
        @foreach ($galleries_photos as $key => $photo)
        <div class="modal fade pop-up-{{$key}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <img src="{{ asset('uploads/photoGallery/'.$photo->image_name) }}" class="img-responsive center-block" alt=""> </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
    <!-- /.row --> 
    </div>
</section>

@endsection

@push('javascript') 
<script type="text/javascript">
    var window_width = $( window ).width();
    
    if(window_width > 767){
        $('.ytCarouselSlide[data-type="multi"] .item').each(function(){
              var next = $(this).next();
              if (!next.length) {
                next = $(this).siblings(':first');
              }
              next.children(':first-child').clone().appendTo($(this));
            
              for (var i=0;i<2;i++) {
                next=next.next();
                if (!next.length) {
                	next = $(this).siblings(':first');
              	}
                
                next.children(':first-child').clone().appendTo($(this));
              }
        });
    } else {}

    var youtube = document.querySelectorAll( ".youtube" );
    for (var i = 0; i < youtube.length; i++) {
        var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/mqdefault.jpg"; 

        var image = new Image();
        image.src = source;
        image.addEventListener( "load", function() {
            youtube[ i ].appendChild( image );
        }( i ) );

        youtube[i].addEventListener( "click", function() {
            var iframe = document.createElement( "iframe" );
            iframe.setAttribute( "frameborder", "0" );
            iframe.setAttribute( "allowfullscreen", "" );
            iframe.setAttribute( "width", "100%" );
            iframe.setAttribute( "loading", "lazy" );
            iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );

            this.innerHTML = "";
            this.appendChild( iframe );
        });
    }

</script>
@endpush
