<!-- Post Social Sharing icons -->
<div class="post-social-share"> 
    <img class="avatar" src="{{ asset('web/img/user2.png') }}" alt="avatar" height="30px"> 
    <span>Update Social Profile Info</span> 
</div>
<!-- Post description -->
<hr>
<div class="template-form"> 
    <form  id="profileUpdateForm" method="POST">
        @csrf
        <div id="errorMsgDiv">
            <div id="newsletterMsg"></div>
        </div>
        <input type="text" class="form-control" name="fb_link" placeholder="Facebook Profile Link" value="{{@$socialLinkInfo->fb_link}}">
        <input type="text" class="form-control" name="twitter_link" placeholder="Twitter Profile Link" value="{{@$socialLinkInfo->twitter_link}}">
        <input type="text" class="form-control" name="linkedin_link" placeholder="Linkedin Profile Link" value="{{@$socialLinkInfo->linkedin_link}}">
        <button type="submit" id="submitBtn" class="service-box-button">Save</button>
    </form>
    <hr>
</div>

<script type="text/javascript">
    $(document).ready(function() {
		$("#profileUpdateForm").on('submit', function(event) {
			event.preventDefault();
			var postData = $(this).serializeArray();
			$.ajax({
				url : "{{route('saveSocialLink', app()->getLocale())}}",
				type: "POST",
				data: postData,
				dataType: 'json',
				success:function(data){
					var status = parseInt(data.status);
					if(data.status ==1) {
						$('#newsletterMsg').html('<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
						$("#submitBtn").val("Save");
						$('#newsletterMsg').show();
						setTimeout(function() {$('#newsletterMsg').hide()}, 3000);
					}
					else if(status==0) {
						$('#newsletterMsg').html('<div class="alert alert-danger fade in"><button type="button" id="close_icon" class="close" data-dismiss="alert" aria-hidden="true">×</button> <i class="fa fa-adjust alert-icon"></i> '+data.messege+'</div>');
						$('#newsletterMsg').on('click', '#close_icon', function() {
							$("#submitBtn").val("Save");
						})
					}
				}
			});
		})
	})
</script>