@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.blog.index')}}">Blog</a></li>
            <li class="active">Create</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-heading" style="border-bottom: 1px solid #ddd; margin-bottom: 20px;">
            <h5 class="panel-title">Blog Create</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" action="{{route('provider.blog.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <fieldset class="content-group">
                    @if (session('msgType'))
                        <div id="msgDiv" class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-styled-left alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold">Opps!</span> {{ $error }}.
                        </div>
                        @endforeach
                    @endif
                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Title <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="title" class="form-control" required="required" placeholder="Title">
                        </div>
                    </div>
                    <!-- /basic text input -->

                    <!-- Basic textarea -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Description <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <textarea rows="5" cols="5" name="description" id="description" class="form-control" required="required" placeholder="Blog Description"></textarea>
                        </div>
                    </div>
                    <!-- /basic textarea -->

                    <!-- Image input -->
                    <div class="form-group">
                        <label class="col-lg-2 control-label text-semibold">Image</label>
                        <div class="col-lg-10">
                            <input type="file" name="image" class="file-input-extensions">
                            <span class="help-block">Allow extensions: <code>jpg</code>, <code>png</code> and <code>jpeg</code> and  Allow Size: <code>640 * 426</code> Only</span>
                        </div>
                    </div>
                    <!-- /Image input -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Active Status <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <div class="checkbox checkbox-switch">
                                <label>
                                    <input type="checkbox" name="status" checked value="1" data-on-text="Yes" data-off-text="No" class="switch">
                                </label>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                    <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                    <a href="{{route('provider.blog.index')}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
                </div>
            </form>
        </div>
    </div>
    <!-- /form validation -->

</div>
<!-- /content area -->
@endsection

@push('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        @if (session('msgType'))
            setTimeout(function() {$('#msgDiv').hide()}, 3000);
        @endif

        $("#description").summernote({
            height: 150
        });
    })
</script>
@endpush
