@extends('layouts.manage')

@section('title','Users')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>Manage Users</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Manage Users</li>
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
          <h3 class="card-title">User List</h3>

          <div class="card-tools">
          <a href="{{route('users.create')}}" class="btn btn-primary pull-right">
            <i class="fas fa-plus"></i> Create User</a>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-hover table-sm">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach ($users as $user)
                    <tr>
                    <td class="{{$user->status==1?'':'user-disable'}}">{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        {{$user->roles->count() == 0 ? 'User has not been assigned any roles yet' : ''}}
                        @foreach ($user->roles as $role)
                            {{$role->display_name}}
                        @endforeach
                    </td>
                    <td>{{($user->status==1?'Enable':'Disable')}}</td>
                    <td>{{$user->created_at->toFormattedDateString()}}</td>
                    <td class="text-right">
                        <a class="button is-outlined btn btn-default btn-sm" href="{{route('users.show', $user->id)}}">View</a>
                        <a class="button is-outlined btn btn-default btn-sm" href="{{route('users.edit', $user->id)}}">Edit</a>
                    </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
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