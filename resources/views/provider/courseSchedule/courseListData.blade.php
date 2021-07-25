@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.assignCourse.index')}}">Assign Courses</a></li>
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
            <h5 class="panel-title">Assign Courses List</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <table class="table table-bordered table-hover datatable-highlight data-list" id="scheduledCourseTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="55%">Course Name</th>
                    <th width="20%">Publish Status</th>
                    <th width="20%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($all_assign_courses))
                    @foreach ($all_assign_courses as $key => $assign_course)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$assign_course->course_name}}</td>
                        <td>
                            @if ($assign_course->publish_status == 1)
                            <span class="label label-success">Active</span>
                            @else 
                            <span class="label label-danger">InActive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{route('provider.scheduledList.index', ['assign_id'=>$assign_course->id])}}" class="btn btn-primary">Schedules <i class="icon-circle-right2 position-right"></i></a>
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

    <!-- Footer -->
    <div class="footer text-muted">
        &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
    </div>
    <!-- /footer -->

</div>
<!-- /content area -->
@endsection

@push('javascript')
<script type="text/javascript">
    // $('#assignCourseTable').DataTable();
    
    $('#scheduledCourseTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 3 }
            ]
    });
</script>
@endpush
