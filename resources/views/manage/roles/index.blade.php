@extends('layouts.manage')

@section('title','Role')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>Manage Roles</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Roles</li>
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
          <h3 class="card-title">Roles</h3>

          <div class="card-tools">
          <a href="{{route('roles.create')}}" class="btn btn-primary pull-right"><i class="fa fa-user-plus"></i> Create New Role</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
          @foreach ($roles as $role)
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h5>{{$role->display_name}}</h5>
                <p>{{$role->name}}</p>
                <p>
                  {{$role->description}}
                </p>
                <div class="icon">
                  <i class="fas fa-user"></i>
                </div>
              </div>
                <a href="{{route('roles.show', $role->id)}}" class="small-box-footer">
                  <div class="fas fa-arrow-circle-right"></div> Details</a>
                <a href="{{route('roles.edit', $role->id)}}" class="small-box-footer">
                  <i class="far fa-edit"></i>Edit</a>
              
            </div>
          </div>
          @endforeach
          </div>
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
