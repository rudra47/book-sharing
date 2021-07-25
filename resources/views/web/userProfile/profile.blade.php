@extends('layouts.default')

@section('content')
<header class="inner"> 
    <!-- Banner -->
    <div class="header-content">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 id="homeHeading"><a href="index-2.html">Home</a> / <span>Profile</span></h1>
          </div>
        </div>
      </div>
    </div>
  </header>
  
<section class="section-bottom-border">
    <div class="container">
      <div class="row">
        <!-- ==== Sidebar Starts Here ==== -->
        <div class="col-md-4 sidebar"> 
			<div class="user-profile">
				@if( !empty($myProfile->image) || $myProfile->image != Null)
					<img src="{{ asset('uploads/studentProfile/'.$myProfile->image)}}" alt="{{$myProfile->image}}">
				@else
					<img src="{{ asset('web/img/news/news1.jpg') }}" alt="">
				@endif
				<a href="changeImage"><i class="fa fa-edit"> Edit</i></a>
			</div>
			<h2>{{ Auth::user()->name }}</h2>
			<!--Sidebar Social Links-->
			<div class="sidebar-social"> 
				<a href="{{ @$socialLinkInfo ->fb_link }}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
				<a href="{{ @$socialLinkInfo ->twitter_link }}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
				<a href="{{ @$socialLinkInfo ->linkedin_link }}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> 
			</div>
			<hr>
			<div id="profile_sidebar">
				<div class="sidebar-post"> 
					<a href="profileInfo" class="pro-act">Profile Info</a>
				</div>
				<div class="sidebar-post"> 
					<a href="updateProfile">Update Info</a>
				</div>
				<div class="sidebar-post"> 
					<a href="updateSocialLink">Update Social Info</a>
				</div>
				<div class="sidebar-post"> 
					<a href="changePassword">Change Password</a>
				</div>
			</div>
        </div>
        <!-- ==== Sidebar Ends Here ==== --> 
		
        <div class="col-md-8 list-container post" style="box-shadow: 0px 5px 20px -11px rgba(150,150,150,0.8); border: 1px solid #f3f2f2; padding: 10px;"> 
			<div style="min-height:100vh;" id="profile_content_area"></div>
        </div>
      </div>
    </div>
</section>
@endsection

@push('javascript')
	<script type="text/javascript">
		$(document).ready(function() {
			var ajax_url = location.hash.replace(/^#/, '');
			if (ajax_url.length < 1) {
				ajax_url = 'profileInfo';
				window.location.hash = ajax_url;
				LoadPageContent(ajax_url);
				$('#profile_sidebar a.pro-act').removeClass('pro-act');
				$('#profile_sidebar').find('a[href='+ajax_url+']').addClass('pro-act');
			}

			window.location.hash = ajax_url;
			LoadPageContent(ajax_url);

			$('#profile_sidebar').on('click', 'a', function(e) {
				e.preventDefault();
				$('#profile_sidebar a.pro-act').removeClass('pro-act');
				$(this).addClass('pro-act');
				var url = $(this).attr('href');
				if (url) {
                    window.location.hash = url;
					LoadPageContent(url);
				}
			});

			$('.user-profile').on('click', 'a', function(e) {
				e.preventDefault();
				$('#profile_sidebar a.pro-act').removeClass('pro-act')
				var url = $(this).attr('href');
				if (url) {
                    window.location.hash = url;
					LoadPageContent(url);
				}
			});


		})

		function LoadPageContent(url) {
			$('#profile_content_area').html(`<div class="loader"></div>`);
			$.ajax({
				mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
				url: url,
				type: "GET",
				dataType: "html",
				success: function (data) {
					if (parseInt(data) === 0) {
					} 
					else {
						$('.preloader').hide();
						$('#profile_content_area').html(data);
					}
				}
			});
		}
	</script>
@endpush