@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.workFlow')}}">Work Flow</a></li>
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
            <h5 class="panel-title">Work Flow Update</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" action="{{route('provider.saveWorkFlow')}}" method="POST" enctype="multipart/form-data">
                {{-- @method('PUT') --}}
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
                        <label class="col-lg-3 control-label text-semibold">Workflow Image</label>
                        <div class="col-lg-6">
                            <div class="file-preview" id="custom_file_preview">
                                <div class="close fileinput-remove text-right" id="custom_close">×</div>
                                <div class="file-preview-thumbnails">
                                    <div class="file-preview-frame" id="preview-1603644588432-0">
                                        <img src="{{ asset('uploads/workflows/'.$workflow->image_name)}}" class="file-preview-image" title="{{$workflow->image_name}}" alt="{{$workflow->image_name}}" style="width:auto;height:160px;">
                                    </div>
                                </div>
                                <div class="clearfix"></div>   
                                <div class="file-preview-status text-center text-success"></div>
                                <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                <input type="hidden" name="image_name" value="{{$workflow->image_name}}">
                            </div>
                            <div id="custom_file_input" style="display: none;">
                                <input type="file" name="image_name" class="file-input-extensions">
                            </div>
                        </div>
                    </div>
                    <!-- /basic text input -->

                    {{-- <div class="form-group">
                        <label class="control-label col-lg-3">Active Status <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <div class="checkbox checkbox-switch">
                                <label>
                                    <input type="checkbox" name="status" @if($workflow->status == 1) checked @endif value="1" data-on-text="Yes" data-off-text="No" class="switch">
                                </label>
                            </div>
                        </div>
                    </div> --}}

                </fieldset>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
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

        $('#custom_file_preview').on('click', '#custom_close', function() {
            $('#custom_file_preview').remove();
            $('#custom_file_input').show();
        })
    })
</script>
@endpush