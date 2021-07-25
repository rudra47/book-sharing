<!-- Post Social Sharing icons -->
<div class="post-social-share"> 
    <img class="avatar" src="{{ asset('web/img/user2.png') }}" alt="avatar" height="30px"> 
    <span>Profile Info</span> 
</div>
<!-- Post description -->
<hr>
<div class="table-responsive">
    <table class="table table-striped" width="100%">
        <tbody>
            <tr>
                <td width="30%">Full Name</td>
                <td>:</td>
                <td>{{$profileInfo->name}}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{$profileInfo->email}}</td>
            </tr>        
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td>{{$profileInfo->phone}}</td>
            </tr>        
        </tbody>
    </table>
</div>
<hr>