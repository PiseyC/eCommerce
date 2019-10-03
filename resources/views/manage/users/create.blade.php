@extends('layouts.manage')

@section('title','Create user')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>Create New User</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Create New User</li>
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('users.store')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input placeholder="Name" type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input placeholder="Email" type="text" class="form-control" name="email" value="{{ old('email') }}" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control input" name="password" id="password" v-if="!auto_password" placeholder="Manually give a password to this user">
                        <div class="icheck-primary">
                            <input id="option" name="auto_generate" type="checkbox" checked="true" v-model="auto_password">
                            <label for="option">Auto Generate Password</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Roles:</label>
                        <input type="hidden" name="roles" :value="rolesSelected" />
                        @foreach ($roles as $role)
                        <div class="icheck-primary">
                          <input name="role" id="role{{$role->id}}" type="checkbox" v-model="rolesSelected" :value="{{$role->id}}" required>
                          <label for="role{{$role->id}}">
                          {{$role->display_name}}
                          </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button class="btn btn-success is-success">Create User</button>
                </div>
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
        auto_password: true,
        rolesSelected: [{!! old('roles') ? old('roles') : '' !!}]
      }
    });
  </script>
@endsection
