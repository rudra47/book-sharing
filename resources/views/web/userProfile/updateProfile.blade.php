<!-- Post Social Sharing icons -->
<div class="post-social-share"> 
    <img class="avatar" src="{{ asset('web/img/user2.png') }}" alt="avatar" height="30px"> 
    <span>Update Profile Info</span> 
</div>
<!-- Post description -->
<hr>
<div class="template-form"> 
    <form  id="profileUpdateForm" method="POST">
        @csrf
        <div id="errorMsgDiv">
            <div id="newsletterMsg"></div>
        </div>
        <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{$profileInfo->name}}" required>
        <input type="email" class="form-control" name="email" placeholder="Enter Your E-Mail" value="{{$profileInfo->email}}" disabled>
        <input type="text" class="form-control" name="phone" placeholder="Your Phone number" value="{{$profileInfo->phone}}" required>
        <button type="submit" id="submitBtn" class="service-box-button">Submit</button>
    </form>
    <hr>
</div>

<script type="text/javascript">
    $(document).ready(function() {
		$("#profileUpdateForm").on('submit', function(event) {
			event.preventDefault();
			$("#submitBtn").val("Submitting...").attr("disabled", "disabled");
			var postData = $(this).serializeArray();
			$.ajax({
				url : "{{route('updateProfileAction', app()->getLocale())}}",
				type: "POST",
				data: postData,
				dataType: 'json',
				success:function(data){
					var status = parseInt(data.status);
					if(data.status ==1) {
						$('#newsletterMsg').html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
						$("#submitBtn").removeAttr("disabled").removeClass("disabled");
						$("#submitBtn").val("Submit");
						setTimeout(function() {$('#newsletterMsg').hide()}, 3000);
					}
					else if(status==0) {
						$('#newsletterMsg').html('<div class="alert alert-danger fade in"><button type="button" id="close_icon" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
						$('#newsletterMsg').on('click', '#close_icon', function() {
							$("#submitBtn").removeAttr("disabled").removeClass("disabled");
							$("#submitBtn").val("Submit");
						})
					}
				}
			});
		})
	})
</script>