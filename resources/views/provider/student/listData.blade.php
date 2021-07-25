@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.studentList')}}">Student</a></li>
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
            <h5 class="panel-title">Student List</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <table class="table table-bordered table-hover datatable-highlight data-list" id="userTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="30%">Student Name</th>
                    <th width="25%">Email</th>
                    <th width="25%">Phone</th>
                    <th width="15%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($all_students))
                    @foreach ($all_students as $key => $student)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{ $student->phone }}</td>
                        <td>
                            @if (isset($student->email_verified_at))
                                {{-- <span class="label label-success">Active</span> --}}
                                <button data="{{$student->id}}" class="user-login btn btn-primary btn-xs mt-5" type="button">Login</button>
                            @else 
                                <span class="label label-danger">InActive</span>
                            @endif
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
    // $('#courseTable').DataTable();
    
    $('#userTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 4 }
            ]
    });
    
    $(document).ready(function() {
        $('#userTable tbody').on('click', '.user-login', function (e) {
            e.preventDefault();
            $.ajax({
                url : '{{route("provider.traineeUserLogin")}}',
                data: {id: $(this).attr('data'), _token: "{{ csrf_token() }}"},
                type: 'GET',
                async: false,
                dataType: "json",
                success: function(data) {
                    if(data.result) {
                        window.open("{{route('profile', app()->getLocale())}}");
                    } else {
                        swal("Cancelled", data.msg, "error");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Cancelled", errorThrown, "error");
                }
            });
        });
    });
</script>
@endpush
