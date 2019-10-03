@extends('layouts.manage')

@section('title','Log Activity')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>User Log Activity</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Log Activity</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Activity List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body p-t-5">
            <table class="table table-bordered table-hover table-responsive table-sm m-b-5">
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Subject</th>
                    <th>URL</th>
                    <th>Method</th>
                    <th>Ip</th>
                    <th width="300px">User Agent</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                @if($logs->count())
                    @foreach($logs as $key => $log)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $log->user->name }}</td>
                        <td>{{ $log->subject }}</td>
                        <td class="text-success">.{{ substr($log->url,22) }}</td>
                        <td><label class="label label-info">{{ $log->method }}</label></td>
                        <td class="text-warning">{{ $log->ip }}</td>
                        <td class="text-danger">{{ $log->agent }}</td>
                        <td>{{$log->created_at}}</td>
                        <td><button v-on:click="ConfirmDelete({{$log->id}})" class="btn btn-danger btn-sm">Delete</button></td>
                    </tr>
                    @endforeach
                @endif
            </table>
            
            {{$logs->links()}}

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <!-------------- Modal Delete ------------------>
  <div id="showDelete" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-trash" aria-hidden="true"></i> Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              Are you sure to delete <span class="delete_title"></span>?
              <input type="hidden" id="deleteid">
          </div>
          <div class="modal-footer">
              <button v-on:click="DeleteItem()" type="button" class="btn btn-danger" data-dismiss="modal">
                  <i class="fa fa-trash" aria-hidden="true"></i> Delete
              </button>
              <button type="button" class="btn btn-default" data-dismiss="modal">
                  Close
              </button>
          </div>
          </div>
      </div>
  </div>

@endsection
@section('scriptjs')
<script>
    var app = new Vue({
      el: '#app',
      data: {
        api_token: '{{Auth::user()->api_token}}'
      },
      methods:{
        ConfirmDelete(id){
            $('.delete_title').html('this Log');
            $('#showDelete').modal('show');
            $("#deleteid").val(id);
        },
        DeleteItem() {
            var id = $("#deleteid").val();
            fetch('/api/deleteLog/'+id+'?api_token='+this.api_token, {
                method: 'delete'
            })
            .then(data => {
                toastr.success('Log activity deleted.');
                location.reload();
            })
            .catch(err => console.log(err));
        },
      }
    });
</script>
@endsection
