@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.scheduledList.index')}}">Course Schedule</a></li>
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
            <h5 class="panel-title">{{$course_name}} Schedule List</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li style="margin-right: 10px;"><a href="{{route('provider.scheduledListCourses')}}" class="btn btn-info add-new"><i class="icon-point-left mr-10"></i>Go Back</a></li>
                    <li style="margin-right: 10px;"><a href="{{route('provider.scheduledList.create', ['assign_id' => $assign_id])}}" class="btn btn-primary add-new">Add New</a></li>
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <table class="table table-bordered table-hover datatable-highlight data-list" id="scheduledListTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="5%">Batch</th>
                    <th width="25%">Schedule Title</th>
                    <th width="20%">Start Date</th>
                    <th width="15%">Start Time</th>
                    <th width="20%">Live Url</th>
                    <th width="10%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($all_schedules))
                    @foreach ($all_schedules as $key => $schedule)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>Batch {{$schedule->batch_no}}</td>
                        <td>{{$schedule->schedule_title}}</td>
                        <td>{{$schedule->start_date}}</td>
                        <td>{{$schedule->start_time}}</td>
                        <td>{{$schedule->start_url}}</td>
                        <td class="text-center">
                            <a href="{{route('provider.scheduledList.edit', [$schedule->id])}}" class="action-icon"><i class="icon-pencil7"></i></a>
                            <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="{{route('provider.scheduledList.destroy', [$schedule->id])}}">@csrf </i></a>
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
    // $('#scheduledListTable').DataTable();
    
    $('#scheduledListTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 5 }
            ]
    });
</script>
@endpush
