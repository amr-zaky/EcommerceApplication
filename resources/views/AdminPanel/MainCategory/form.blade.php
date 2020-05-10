@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{isset($MainCategory)?'Edit '.$MainCategory->name :'ADD'}}</li>
                    </ol>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form  action="{{(isset($MainCategory))?route('MainCategory.update',$MainCategory):route('MainCategory.store')}}" method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($MainCategory)?method_field('PUT'):''}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">English Name</label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Enter Name" value="@if(old('name')){{old('name')}}@elseif(isset($MainCategory->name)){{$MainCategory->name}}@endif" required>
                                </div>

                                <div class="form-group">
                                    <label for="name">Arabic Name</label>
                                    <input type="text" name="nameAr" class="form-control"
                                           placeholder="Enter Name" value="@if(old('nameAr')){{old('nameAr')}}@elseif(isset($MainCategory->nameAr)){{$MainCategory->nameAr}}@endif" required>
                                </div>


                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" @if(!isset($MainCategory))required @endif>
                                    <br>
                                    @if(isset($MainCategory->image))
                                        <img src="{{url($MainCategory->image)}}" width="250" height="250">
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="view_order">View Order</label>
                                    <input type="number" class="form-control" name="displayOrder" value="@if(old('displayOrder')){{old('displayOrder')}}@elseif(isset($MainCategory->displayOrder)){{$MainCategory->displayOrder}}@endif">
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
