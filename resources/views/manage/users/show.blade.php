@extends('layouts.manage')

@section('title','Show User')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>View User Details</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">View User Details</li>
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
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
          <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary pull-right"><i class="fa fa-user"></i> Edit User</a>
          </div>
        </div>
        <div class="card-body">
            <div class="fieldset">
                <label>Name</label>
                <pre>{{$user->name}}</pre>
            </div>

            <div class="fieldset">
                <label>Email</label>
                <pre>{{$user->email}}</pre>
            </div>

            <div class="fieldset">
                <label>Roles</label>
                <ul>
                {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet' : ''}}
                @foreach ($user->roles as $role)
                    <li>{{$role->display_name}} ({{$role->description}})</li>
                @endforeach
                </ul>
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