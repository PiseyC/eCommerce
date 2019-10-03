@extends('layouts.manage')

@section('title','Permission')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>Permission Details</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Permission Details</li>
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
          <h3 class="card-title">Update Permission</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form action="{{route('permissions.update', $permission->id)}}" method="POST">
              {{csrf_field()}}
              {{method_field('PUT')}}

              <div class="fieldset">
                <div class="form-group">
                  <label>Name (Display Name)</label>
                  <input placeholder="Name" type="text" class="form-control" name="display_name" id="display_name" value="{{$permission->display_name}}" required>
                </div>
                <div class="form-group">
                  <label>Slug <small>(Cannot be changed)</small></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{$permission->name}}" disabled required>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <input type="text" class="form-control" name="description" id="description" placeholder="Describe what this permission does" value="{{$permission->description}}" required>
                  
                </div>
              </div>

              <button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('scriptjs')
<script>
    var app = new Vue({
      el: '#app',
      data: {
        api_token: '{{Auth::user()->api_token}}'
      }
    });
</script>
@endsection
