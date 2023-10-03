@extends('web.layouts.main')

@section('page-css')
    <link rel="stylesheet" media="screen, print" href="{{asset('web_assets/plugins/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('web_assets/plugins/toastr/toastr.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" media="screen, print" href="{{asset('web_assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>帳號管理</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">系統管理模組</li>
              <li class="breadcrumb-item active">帳號管理</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">帳號管理</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="dt" class="table table-bordered table-hover table-striped table-fixed table-wave w-100">

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('page-js')
    <script type="text/javascript" src="{{asset('web_assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web_assets/plugins/toastr/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web_assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
@endsection

@section('inline-js')
    <script type="module">
        import {Manager} from "{{asset('web_assets/js/page/admin/manager/manager.js')}}?v=1"

        let url = '/web_api/admin/users';

        $(document).ready(function () {

            let manager = new Manager(url);
            manager.creteTable('#dt');
        });
    </script>
@endsection
