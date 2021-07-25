<form class="form-horizontal form-validate-jquery" action="{{route('provider.blog.commentPublishAction', [$commentId] )}}" method="POST">
    @csrf
    <div class="panel panel-flat">
        <div class="panel-body" id="modal-container">
            <select class="select2 select-search col-lg-8" id="select_status" name="publish_status" required="">
                <option value="">Select Status</option>
                    <option value="0" @if (@$comment->status == 0) selected @endif>Pending</option>
                    <option value="1" @if (@$comment->status == 1) selected @endif>Published</option>
            </select>
        </div>
    </div>
    </form>
    <script type="text/javascript">
        $("#select_status").select2({ dropdownParent: "#modal-container" });
    </script>
    