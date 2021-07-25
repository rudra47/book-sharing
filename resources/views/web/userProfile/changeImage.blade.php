<!-- Post Social Sharing icons -->
<div class="post-social-share"> 
    <img class="avatar" src="{{ asset('web/img/user2.png') }}" alt="avatar" height="30px"> 
    <span>Update Profile Image</span> 
</div>
<!-- Post description -->
<hr>
<div class="template-form"> 
    <form  id="profileUpdateForm" method="POST" enctype="multipart/form-data">
        @method('PUT')
		@csrf
        <div id="errorMsgDiv">
            <div id="newsletterMsg"></div>
        </div>

		<div class="row">
			<div class="row text-center">
				<div class="col-lg-10">
					<div id="upload-demo"></div>
				</div>
			</div>
			<div class="row col-lg-10">
				<div class="col-lg-4">
					<strong>Select Image:</strong>
					<br/>
					<input type="file" id="image" name="image" required value="{{ asset('uploads/studentProfile/'.$myProfile->image)}}">
				</div>
				<div class="col-lg-4 pull-right">
					<p><button id="submit" type="button" class="btn btn-info btn-block btn-block upload-image service-box-button" style="margin-top:2%; overflow: visible;">Save Image</button></p>
				</div>
			</div>
		</div>

        {{-- <button type="submit" id="submitBtn" class="service-box-button">Submit</button> --}}
    </form>
    <hr>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        @if (session('msgType'))
            setTimeout(function() {$('#msgDiv').hide()}, 6000);
        @endif
        
    });

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
     
     
    var resize = $('#upload-demo').croppie({
        enableExif: true,
        // enableOrientation: true,    
        viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: 250,
            height: 250,
            type: 'square' //square
        },
        boundary: {
            width: 350,
            height: 350
        }
    });

	resize.croppie('bind', {
      url: "{{asset('uploads/studentProfile/'.$myProfile->image)}}"
  })
     
     
    $('#image').on('change', function () { 
        $(".upload-image").show();
      	var reader = new FileReader();
        reader.onload = function (e) {
          resize.croppie('bind',{
            url: e.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
    });
     
     
    $('.upload-image').on('click', function (ev) {
        ev.preventDefault();

		resize.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (img) {
			$.ajax({
			url: "{{route('saveImage', app()->getLocale())}}",
			type: "POST",
			data: {"image":img, "_token": "{{csrf_token()}}"},
			success: function (data) {
					let status = parseInt(data.status);
					if(status == 1) {
						$(".user-profile").find("img").attr("src", img);
						$('#newsletterMsg').html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
						$('#newsletterMsg').show();
						setTimeout(function() {$('#newsletterMsg').hide()}, 3000);
					} else if(status == 0) {
						$('#newsletterMsg').html('<div class="alert alert-danger fade in"><button type="button" id="close_icon" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
						$('#newsletterMsg').on('click', '#close_icon', function() {
							// $("#submitBtn").removeAttr("disabled").removeClass("disabled");
							// $("#submitBtn").val("Submit");
						})
					}
			}
			});
		});
    });
</script>