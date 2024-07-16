@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pages Management </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cms Pages </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Cms Pages</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="cmspages" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Url</th>
                    <th>Created On (s)</th>
                    <th>Actions</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach($cms_pages as $page)
                    <tr>
                        <td>{{$page->title}}</td>
                        <td>{{$page->url}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>
                        <a title="Edit Cms Page" href="{{url('admin/add-edit-page/'.$page->id)}}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                        <a title="Delete CMS Page" href="javascript:void(0)" class="confirmDelete" record="page" recordid="{{$page->id}}"><i class="fas fa-trash"></i></a>&nbsp;&nbsp;

                        @if($page->status == 1)
                        <a class="updateCmsPageStatus" id="page-{{$page->id}}" page_id={{$page->id}} href="javascript:void(0)" ><i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i></a>&nbsp;&nbsp;
                        @else
                        <a class="updateCmsPageStatus" id="page-{{$page->id}}" page_id={{$page->id}} href="javascript:void(0)" ><i class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i></a>&nbsp;&nbsp;
                        @endif
                        </td>

                    </tr>
                    @endforeach
                  </tbody>




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
@endsection
