@extends('layouts.manage')

@section('title','Edit User')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>Edit User</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit User</li>
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
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
            <form action="{{route('users.update', $user->id)}}" method="POST">
                {{method_field('PUT')}}
                {{csrf_field()}}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name:</label>
                            <input placeholder="Name" type="text" class="input form-control" name="name" id="name" value="{{$user->name}}" required>
                        </div>

                        <div class="form-group">
                            <label>Email:</label>
                            <input placeholder="Email" type="text" class="input form-control" name="email" id="email" value="{{$user->email}}" required>
                        </div>

                        <div class="form-group">
                            <div class="icheck-primary">
                                <input id="option1" type="radio" v-model="password_options" name="password_options" value="keep">
                                <label for="option1">Do Not Change Password</label>
                            </div>
                            <div class="icheck-primary">
                                <input id="option2" type="radio" v-model="password_options" name="password_options" value="auto">
                                <label for="option2">Auto-Generate New Password</label>
                            </div>
                            <div class="icheck-primary">
                                <input id="option3" type="radio" v-model="password_options" name="password_options" value="manual">
                                <label for="option3">Manually Set New Password</label>
                                <input type="text" class="form-control m-t-5" name="password" id="password" v-if="password_options == 'manual'" placeholder="Manually give a password to this user">
                            </div>
                        </div>    
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Roles:</label>
                            <input type="hidden" name="roles" :value="rolesSelected" />
                            @foreach ($roles as $role)
                            <div class="icheck-primary">
                              <input id="role{{$role->id}}" type="checkbox" v-model="rolesSelected" :value="{{$role->id}}">
                              <label for="role{{$role->id}}">
                                {{$role->display_name}}
                              </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status:</label>
                            <div class="icheck-primary">
                                <input id="enable" type="radio" v-model="status" name="status" value="1">
                                <label for="enable">Enable</label>
                            </div>
                            <div class="icheck-primary">
                                <input id="disable" type="radio" v-model="status" name="status" value="0">
                                <label for="disable">Disable</label>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Update</button>
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
    password_options: 'keep',
    rolesSelected: {!! $user->roles->pluck('id') !!},
    status: {{ $user->status }}
  }
});

</script>
@endsection