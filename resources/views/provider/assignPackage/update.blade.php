@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.assignPackage.index')}}">Assign Package</a></li>
            <li class="active">Update</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-heading" style="border-bottom: 1px solid #ddd; margin-bottom: 20px;">
            <h5 class="panel-title">Assign Package Update</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" action="{{route('provider.assignPackage.update', [$assign_package_info->id])}}" method="POST">
                @method('PUT')
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
                        <label class="control-label col-lg-2">Select Course <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="select-search" name="course_id" required="required">
                                <option value="">Select</option>
                                @foreach ($courses as $course)
                                <option value="{{$course->id}}" @if ($course->id == $assign_package_info->course_id) selected @endif>{{$course->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Package Type <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <select class="select-search" name="package_type" required="required">
                                <option value="">Select</option>
                                <option value="0" @if($assign_package_info->package_type == 0) selected @endif>Offline</option>
                                <option value="1" @if($assign_package_info->package_type == 1) selected @endif>Online</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Package Name <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="package_name" class="form-control" required="required" placeholder="Package Name" value="{{$assign_package_info->package_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Package Sub Title <span class="text-danger">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="package_subtitle" class="form-control" required="required" placeholder="Package Sub Title" value="{{$assign_package_info->package_subtitle}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Package Price</label>
                        <div class="col-lg-10">
                            <div class="col-lg-3">
                                <div class="checkbox checkbox-switch">
                                    <label>
                                        <input type="checkbox" name="paid_status" id="paid_status" @if($assign_package_info->paid_status == 1) checked @endif value="1" data-on-text="Paid" data-off-text="Free" class="switch">
                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-lg-9 input-group">
                                    <span class="input-group-addon">৳</span> 
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Amount" value="{{$assign_package_info->price}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Package Duration</label>
                        <div class="col-lg-10">
                            <div class="input-group">
                                <input type="text" name="duration" class="form-control" placeholder="Number of Days" value="{{$assign_package_info->duration}}">
                                <span class="input-group-addon">Days</span>
                            </div>
                        </div>
                    </div>
                    <!-- /basic text input -->
                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
                    <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                    <a href="{{route('provider.assignPackage.index')}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
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

        $("#package_details").summernote({
            height: 150
        });

        $('.bootstrap-switch-on').on('click', function() {
            if($('input[type="checkbox"]').is(":checked")){
                $('#price').prop("disabled", false);
            }
            else if($('input[type="checkbox"]').is(":not(:checked)")){
                $('#price').prop("disabled", true);
            }
        });
        $('.bootstrap-switch-off').on('click', function() {
            if($('input[type="checkbox"]').is(":checked")){
                $('#price').prop("disabled", false);
            }
            else if($('input[type="checkbox"]').is(":not(:checked)")){
                $('#price').prop("disabled", true);
            }
        });
    })
</script>
@endpush
