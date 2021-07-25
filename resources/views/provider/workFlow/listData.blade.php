@extends('provider.layouts.default')

@section('content')
<!-- Page header -->
<div class="page-header">

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route('provider.home')}}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="{{route('provider.workFlow.index')}}">Work Flow</a></li>
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
            <h5 class="panel-title">Work Flow List</h5>
            <div class="heading-elements">
                <ul class="icons-list" style="margin-top: 0px">
                    <li style="margin-right: 10px;"><a href="{{route('provider.workFlow.create')}}" class="btn btn-primary add-new">Add New</a></li>
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        {{-- <div class="panel-body" style="text-align: right">
            <a href="#" class="btn btn-primary">Add New</a>
        </div> --}}
        <table class="table table-bordered table-hover datatable-highlight data-list" id="workFlowTable">
            <thead>
                <tr>
                    <th width="5%">SL.</th>
                    <th width="25%">Image Name</th>
                    <th width="40%">Image Thumb</th>
                    <th width="20%">Active Status</th>
                    <th width="10%" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($all_workflows))
                    @foreach ($all_workflows as $key => $workflow)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$workflow->image_name}}</td>
                        <td><img src="{{ asset('uploads/workflows/thumb/'.$workflow->image_name)}}" alt=""></td>
                        <td>
                            @if ($workflow->status == 1)
                            <span class="label label-success">Active</span>
                            @else 
                            <span class="label label-danger">InActive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{route('provider.workFlow.edit', [$workflow->id])}}" class="action-icon"><i class="icon-pencil7"></i></a>
                            <a href="#" class="action-icon"><i class="icon-trash" id="delete" delete-link="{{route('provider.workFlow.destroy', [$workflow->id])}}">@csrf </i></a>
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
    // $('#workFlowTable').DataTable();
    
    $('#workFlowTable').DataTable({
        dom: 'lBfrtip',
            "iDisplayLength": 10,
            "lengthMenu": [ 10, 25,30, 50 ],
            columnDefs: [
                {'orderable':false, "targets": 4 }
            ]
    });
</script>
@endpush
