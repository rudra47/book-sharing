<!-- Post Social Sharing icons -->
<div class="post-social-share"> 
    <img class="avatar" src="{{ asset('web/img/user2.png') }}" alt="avatar" height="30px"> 
    <span>Change Password</span> 
</div>
<!-- Post description -->
<hr>
<div class="template-form"> 
    <form  id="changePasswordForm" method="POST">
        @csrf
		<div class="alert alert-success" id="messageDiv" style="display: none;">
			<strong id="status"></strong> <span id="message"></span>
		</div>

        <input type="password" class="form-control" name="oldPassword" placeholder="Old Password" required>
        <input type="password" class="form-control" name="newPassword" placeholder="New Password" required>
        <input type="password" class="form-control" name="confirmNewPassword" placeholder="Confirm New Password" required>
        <button type="submit" id="submitBtn" class="service-box-button">Change</button>
    </form>
    <hr>
</div>

<script type="text/javascript">
    $(document).ready(function() {
		$("#changePasswordForm").on('submit', function(event) {
			event.preventDefault();
			var new_password = $("input[name=newPassword]").val();
            var confirm_password = $("input[name=confirmNewPassword]").val();
			var postData = $(this).serializeArray();

			if (new_password != confirm_password) {
				$("#changePasswordForm").find('.alert').removeClass("alert-success").addClass("alert-danger");
                $("#messageDiv").show().delay(5000).fadeOut();
                $('#status').html('Wrong! ');
                $('#message').html('New password and confirm password do not match.');
                setTimeout(function() {$('#messageDiv').hide()}, 3000);
                $("#submitBtn").val("Change").removeAttr("disabled").removeClass("disabled");
			} else {
				$.ajax({
                    url : "{{route('savePassword', app()->getLocale())}}",
                    type: "POST",
                    data: postData,
                    dataType: 'json',
                    success:function(response){
                        if (response.status=='success') {
                            $("#messageDiv").show().delay(5000).fadeOut();
                            $('#status').html("Success! ");
                            $('#message').html(response.message);
                            setTimeout(function() {$('#messageDiv').hide()}, 3000);
                        } else {
                            $("#changePasswordForm").find('.alert').removeClass("alert-success").addClass("alert-danger");
                            $("#messageDiv").show().delay(5000).fadeOut();
                            $('#status').html("Wrong! ");
                            $('#message').html(response.message);
                            setTimeout(function() {$('#messageDiv').hide()}, 3000);
                        }
                        $("#changePasswordForm").find("input").val("");
                        $("#submitBtn").val("Change").removeAttr("disabled").removeClass("disabled");
                    }
                });
			}
		})
	})
</script>