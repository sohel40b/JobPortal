@extends('admin.layouts.admin_layout')
@section('content')
<style type="text/css">
    .table td, .table th {
        font-size: 12px;
        line-height: 2.42857 !important;
    }	
</style>
<div class="page-content-wrapper"> 
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content"> 
        <!-- BEGIN PAGE HEADER--> 
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li> <a href="{{ route('admin.home') }}">Home</a> <i class="fa fa-circle"></i> </li>
                <li> <span>Training</span> </li>
            </ul>
        </div>
        <!-- END PAGE BAR --> 
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title">Manage Training <small>Training</small> </h3>
        <!-- END PAGE TITLE--> 
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12"> 
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption"> <i class="icon-settings font-dark"></i> <span class="caption-subject font-dark sbold uppercase">Training</span> </div>
                        <div class="actions"> <a href="{{ route('create.training') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Add New Training</a> </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <form method="post" role="form" id="training-search-form">
                                <table class="table table-striped table-bordered table-hover"  id="trainingDatatableAjax">
                                    <thead>
                                        <tr role="row" class="filter">
                                            <td><input type="text" class="form-control" name="title" id="title" autocomplete="off" placeholder="Training title"></td>
                                            <td><input type="text" class="form-control" name="description" id="description" autocomplete="off" placeholder="Training description"></td>
                                        </tr>
                                        <tr role="row" class="heading">
                                            <th>Training title</th>
                                            <th>Training description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY --> 
</div>
@endsection
@push('scripts') 
<script>
    $(function () {
        var oTable = $('#trainingDatatableAjax').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: false,
            /*		
             "order": [[1, "asc"]],            
             paging: true,
             info: true,
             */
            ajax: {
                url: '{!! route('fetch.data.training') !!}',
                data: function (d) {
                    d.title = $('#title').val();
                    d.description = $('#description').val();
                }
            }, columns: [
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#training-search-form').on('submit', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#title').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
        $('#description').on('keyup', function (e) {
            oTable.draw();
            e.preventDefault();
        });
    });
    function deleteTraining(id, is_default) {
        var msg = 'Are you sure?';
        if (confirm(msg)) {
            $.post("{{ route('delete.training') }}", {id: id, _method: 'DELETE', _token: '{{ csrf_token() }}'})
                    .done(function (response) {
                        if (response == 'ok')
                        {
                            var table = $('#trainingDatatableAjax').DataTable();
                            table.row('trainingDtRow' + id).remove().draw(false);
                        } else
                        {
                            alert('Request Failed!');
                        }
                    });
        }
    }
   
</script>
@endpush