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
              <li class="breadcrumb-item active">{{$title}}</li>
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
                <h3 class="card-title">{{$title}}</h3>
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
              <form name = "cmsForm"  id="cmsForm" action="{{url('admin/add-edit-cms-page')}}" method="post">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title*</label>
                    <input type="text"  name="title" class="form-control" id="exampleInputEmail1"  placeholder="Enter Title" value="" >
                  </div>
                  <div class="form-group">
                    <label for="url">URL*</label>
                    <input name="url" id="url" type="text" class="form-control" id="name" placeholder="Url" value="">
                  </div>

                  <div class="form-group">
                    <label  for="description">Description*</label>
                    <input name="description" type="text" class="form-control" id="description" placeholder="description" value="">
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
