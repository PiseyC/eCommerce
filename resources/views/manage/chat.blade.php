@extends('layouts.manage')

@section('title','Chat')

@section('stylesheet')
<style>
.card-body{
    padding: 0px !important;
}
</style>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4>Let's chat</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('manage.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Chat</li>
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
          <h3 class="card-title">Chat Messanger</h3>

          <div class="card-tools">
            
          </div>
        </div>
        <div class="card-body">
            <chat-app :user="{{ auth()->user() }}"></chat-app>
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