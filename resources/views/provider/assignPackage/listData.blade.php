@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.assignPackage.index')}}">Assigned Package</a></li>
            <li class="active">List Data</li>
        </ul>
    </div>
</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">

    <!-- Highlighting rows and columns -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Assigned Package List</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li style="margin-right: 10px;"><a href="{{route('provider.assignPackage.create')}}" class="btn btn-primary add-new">Add New</a></li>
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        @if (session('msgType'))
            @if(session('msgType') == 'danger')
                <div id="msgDiv" class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
                </div>
            @else
            <div id="msgDiv" class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
            </div>
            @endif
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-styled-left alert-bordered">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                <span class="text-semibold">Opps!</span> {{ $error }}.
            </div>
            @endforeach
        @endif

        <table class="table table-bordered table-hover datatable-highlight data-list" id="assignCourseTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="20%">Course Name</th>
                    <th width="5%">Type</th>
                    <th width="20%">Package Name</th>
                    <th width="15%">SubTitle</th>
                    <th width="10%">Duration</th>
                    <th width="10%">Price</th>
                    <th width="10%">Publish Status</th>
                    <th width="5%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($all_assign_packages))
                    @foreach ($all_assign_packages as $key => $assign_package)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$assign_package->course_name}}</td>
                        <td>
                            @if ($assign_package->package_type == 0)
                            <span class="label label-success">Offline</span>
                            @else 
                            <span class="label label-danger">Online</span>
                            @endif
                        </td>
                        <td>{{$assign_package->package_name}}</td>
                        <td>{{$assign_package->package_subtitle}}</td>
                        <td>{{$assign_package->duration}} Days</td>
                        <td>
                            @if ($assign_package->paid_status == 1)
                                {{$assign_package->price}} ৳
                            @else 
                                <span class="label label-info">{{'Free'}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($assign_package->publish_status == 1)
                            <span class="label label-success">Published</span><br>
                            @else 
                            <span class="label label-danger">Pending</span><br>
                            @endif
                            <button type="button" class="btn btn-info btn-xs mb-5 open-modal" modal-title="Package Publish Update" modal-type="update" modal-size="medium" modal-class="" selector="Assign" modal-link="{{route('provider.packagePublish', [$assign_package->id])}}"> Publish Status </button>
                        </td>
                        <td class="text-center">
                            <a href="{{route('provider.assignPackage.edit', [$assign_package->id])}}" class="action-icon"><i class="icon-pencil7"></i></a>
                            <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="{{route('provider.assignPackage.destroy', [$assign_package->id])}}">@csrf </i></a>
                            <a href="{{route('provider.assignPackageFeatureList', [$assign_package->id])}}" class="btn btn-primary btn-xs">Add Feature</a>
                        </td>
                    </tr> 
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No Data Found!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- /highlighting rows and columns -->
</div>
<!-- /content area -->
@endsection

@push('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        @if (session('msgType'))
            setTimeout(function() {$('#msgDiv').hide()}, 3000);
        @endif
    });
    
    $('#assignCourseTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 3 },
                {'orderable':false, "targets": 4 },
                {'orderable':false, "targets": 7 },
                {'orderable':false, "targets": 8 },
            ]
    });
</script>
@endpush
