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
            <h4>Edit {{$role->display_name}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit {{$role->display_name}}</li>
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
          <h3 class="card-title">Update</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form action="{{route('roles.update', $role->id)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row">
              <div class="col-6">
                  <div class="box">
                    <article>
                      <div class="media-content">
                        <div class="content">
                          <h2 class="title">Role Details:</h1>
                          <div class="fieldset">
                            <p class="control">
                              <label>Name (Human Readable)</label>
                              <input type="text" class="form-control" name="display_name" value="{{$role->display_name}}" id="display_name" required>
                            </p>
                          </div>
                          <div class="fieldset">
                            <p class="control">
                              <label>Slug (Can not be edited)</label>
                              <input type="text" class="form-control" name="name" value="{{$role->name}}" disabled id="name" required>
                            </p>
                          </div>
                          <div class="fieldset">
                            <p class="control">
                              <label>Description</label>
                              <input type="text" class="form-control" value="{{$role->description}}" id="description" name="description" required>
                            </p>
                          </div>
                          <input type="hidden" :value="permissionsSelected" name="permissions">
                        </div>
                      </div>
                    </article>
                  </div>
              </div>
  
              <div class="col-6">
                <div class="column">
                  <div class="box">
                    <article class="media">
                      <div class="media-content">
                        <div class="content">
                          <h2 class="title">Permissions:</h1>
                          
                            @foreach ($permissions as $permission)
                              <div class="icheck-primary">
                                <input name="roles" id="role{{$permission->id}}" v-model="permissionsSelected" type="checkbox" :value="{{$permission->id}}">
                                <label for="role{{$permission->id}}">
                                {{$permission->display_name}} ><em>({{$permission->description}})</em>
                                </label>
                              </div>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </article>
                  </div> <!-- end of .box -->

                  <button class="btn btn-primary m-t-10"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
                </div>
              </div>
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
      permissionsSelected: {!!$role->permissions->pluck('id')!!}
    }
  });
  </script>
@endsection
