@extends('admin.layouts.layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admin Management </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Fail !</strong> {!! Session::get('error_message') !!}

                </div>
            @endif
             @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success !</strong> {!! Session::get('success_message') !!}

                </div>
            @endif

               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <form method="post" action="{{url('admin/update-admin-details')}}">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input  name="email" class="form-control" id="exampleInputEmail1"  placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email}}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{ Auth::guard('admin')->user()->name}}">
                  </div>

                  <div class="form-group">
                    <label  for="mobile">Mobile</label>
                    <input name="mobile" type="text" class="form-control" id="mobile" placeholder="mobile" value="{{ Auth::guard('admin')->user()->mobile}}">
                  </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input name="image" type="file" class="form-control" id="image" placeholder="image">
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
    <!-- /.content -->
    </div>
    <!-- /.content -->
</div>

@endsection
