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
            <h4>Create New Permission</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Create New Permission</li>
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
          <form action="{{route('permissions.store')}}" method="POST">
              {{csrf_field()}}

              <div class="form-group">
                  <div class="icheck-primary d-inline">
                      <input id="option1" type="radio" v-model="permissionType" name="permission_type" value="basic">
                      <label for="option1">Basic Permission</label>
                  </div>
                  <div class="icheck-primary d-inline">
                      <input id="option2" type="radio" v-model="permissionType" name="permission_type" value="crud">
                      <label for="option2">CRUD Permission</label>
                  </div>
              </div>

              <div class="fieldset" v-if="permissionType == 'basic'">
                <label>Name (Display Name)</label>
                <p class="control">
                  <input placeholder="Name" type="text" class="form-control" name="display_name" id="display_name" required>
                </p>
              </div>

              <div class="fieldset" v-if="permissionType == 'basic'">
                <label>Slug</label>
                <p class="control">
                  <input placeholder="Slug" type="text" class="form-control" name="name" id="name" required>
                </p>
              </div>

              <div class="fieldset" v-if="permissionType == 'basic'">
                <label>Description</label>
                <p class="control">
                  <input placeholder="Description" type="text" class="form-control" name="description" id="description" placeholder="Describe what this permission does" required>
                </p>
              </div>


              <div class="fieldset" v-if="permissionType == 'crud'">
                <label>Resource</label>
                <p class="control">
                  <input type="text" class="form-control" name="resource" id="resource" v-model="resource" placeholder="The name of the resource">
                </p>
              </div>

              <div class="columns" v-if="permissionType == 'crud'">
                <div class="column is-one-quarter">
                  
                  <div class="icheck-primary d-inline">
                      <input id="create" name="" type="checkbox" value="create" v-model="crudSelected">
                      <label for="create">Create</label>
                  </div>
                  <div class="icheck-primary d-inline">
                      <input id="read" name="" type="checkbox" value="read" v-model="crudSelected">
                      <label for="read">Read</label>
                  </div>
                  <div class="icheck-primary d-inline">
                      <input id="update" name="" type="checkbox" value="update" v-model="crudSelected">
                      <label for="update">Update</label>
                  </div>
                  <div class="icheck-primary d-inline">
                      <input id="delete" name="" type="checkbox" value="delete" v-model="crudSelected">
                      <label for="delete">Delete</label>
                  </div>
                </div> <!-- end of .column -->

                <input type="hidden" name="crud_selected" :value="crudSelected">

                <div class="column">
                  <table class="table table-sm" v-if="resource.length >= 3">
                    <thead>
                      <th>Name</th>
                      <th>Slug</th>
                      <th>Description</th>
                    </thead>
                    <tbody>
                      <tr v-for="item in crudSelected">
                        <td v-text="crudName(item)"></td>
                        <td v-text="crudSlug(item)"></td>
                        <td v-text="crudDescription(item)"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <button class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Create Permission</button>
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
        permissionType: 'basic',
        resource: '',
        crudSelected: ['create', 'read', 'update', 'delete']
      },
      methods: {
        crudName: function(item) {
          return item.substr(0,1).toUpperCase() + item.substr(1) + " " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
        },
        crudSlug: function(item) {
          return item.toLowerCase() + "-" + app.resource.toLowerCase();
        },
        crudDescription: function(item) {
          return "Allow a User to " + item.toUpperCase() + " a " + app.resource.substr(0,1).toUpperCase() + app.resource.substr(1);
        }
      }
    });
  </script>
@endsection
