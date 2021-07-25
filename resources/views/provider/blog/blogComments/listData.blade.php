@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.blog.index')}}">Blog Comments</a></li>
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
            <h5 class="panel-title">Blog Comments</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li style="margin-right: 10px;"><a href="{{route('provider.blog.create')}}" class="btn 
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <table class="table table-bordered table-hover datatable-highlight data-list" id="studentTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="25%">User Name</th>
                    <th width="40%">Comment</th>
                    <th width="15%">Active Status</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($comments))
                    @foreach ($comments as $key => $comment)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$comment->name}}</td>
                        <td>{!! $comment->comment !!}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-xs mb-5 open-modal" modal-title="Comment Publish Update" modal-type="update" modal-size="medium" modal-class="" selector="Assign" modal-link="{{route('provider.blog.commentPublish', [$comment->id])}}"> Publish Status </button>
                        </td>
                    </tr> 
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No Data Found!</td>
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
    // $('#studentTable').DataTable();
    
    $('#studentTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 3 }
            ]
    });
</script>
@endpush
