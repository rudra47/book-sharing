@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.allUsers.index')}}">All Users</a></li>
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
            <h5 class="panel-title">Users List</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <table class="table table-bordered table-hover datatable-highlight data-list" id="courseTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="15%">Image</th>
                    <th width="15%">Book Id</th>
                    <th width="20%">Name</th>
                    <th width="25%">Auther Name</th>
                    <th width="10%">Language</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($books))
                    @foreach ($books as $key => $book)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>
                            <img src="{{ asset('uploads/book/thumb/'.$book->book_thumb)}}" class="" alt="{{$book->book_thumb}}" width="100">
                        </td>
                        <td> {{$book->book_id}}</td>
                        <td> {{$book->title}} </td>
                        <td> {{$book->author_name}} </td>
                        <td> {{$book->language_name}} </td>
                        <td>
                            @if ($book->available_status ==1)
                                <span class="text-success">Available</span>
                            @else
                                <span class="text-danger">Not Available</span>
                            @endif
                        </td>
                    </tr> 
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">No Data Found!</td>
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
    
    $('#courseTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 1 }
            ]
    });
</script>
@endpush
