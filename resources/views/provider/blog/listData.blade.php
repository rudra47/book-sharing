@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.blog.index')}}">Blog</a></li>
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
            <h5 class="panel-title">Blog</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li style="margin-right: 10px;"><a href="{{route('provider.blog.create')}}" class="btn btn-primary add-new">Add New</a></li>
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        {{-- <div class="panel-body" style="text-align: right">
            <a href="#" class="btn btn-primary">Add New</a>
        </div> --}}
        <table class="table table-bordered table-hover datatable-highlight data-list" id="studentTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="5%">Image</th>
                    <th width="30%">Title</th>
                    <th width="40%">Description</th>
                    <th width="5%">Comments</th>
                    <th width="5%">Status</th>
                    <th width="10%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($all_blogs))
                    @foreach ($all_blogs as $key => $blog)
                    <tr>
                        <td>{{++$key}}</td>
                        <td><img src="{{ asset('uploads/blog/thumb/'.$blog->image)}}" alt=""></td>
                        <td>{{$blog->title}}</td>
                        <td>{!! Str::words($blog->description, '20') !!}</td>
                        <td>
                            <a href="{{ route('provider.blog.commentList', [$blog->id]) }}" class="btn btn-sm btn-success p-0">Comments</a>
                        </td>
                        <td>
                            @if ($blog->status == 1)
                            <span class="label label-success">Active</span>
                            @else 
                            <span class="label label-danger">InActive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{route('provider.blog.edit', [$blog->id])}}" class="action-icon"><i class="icon-pencil7"></i></a>
                            <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="{{route('provider.blog.destroy', [$blog->id])}}">@csrf </i></a>
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
    // $('#studentTable').DataTable();
    
    $('#studentTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 4 }
            ]
    });
</script>
@endpush
