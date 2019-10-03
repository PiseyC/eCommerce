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
            <h4>{{$role->display_name}}<small><em>({{$role->name}})</em></small></h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">{{$role->display_name}}
              <small><em>({{$role->name}})</em></small></li>
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
          <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary pull-right"><i class="fa fa-user-plus"></i> Edit this Role</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <h1 class="title pull-left">
                {{$role->display_name}}
                <small><em>({{$role->name}})</em></small>
              </h1>
              
              <h5>{{$role->description}}</h5>
            </div>
            <div class="col-6">
              <h2 class="title">Permissions:</h1>
              <ul>
                @foreach ($role->permissions as $r)
                  <li>{{$r->display_name}} <em class="m-l-15">({{$r->description}})</em></li>
                @endforeach
              </ul>
            </div>
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