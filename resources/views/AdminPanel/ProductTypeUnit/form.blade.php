@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{isset($ProductTypeUnit)?'Edit '.$ProductTypeUnit->name :'ADD'}}</li>
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
                        <form  action="{{(isset($ProductTypeUnit))?route('ProductTypeUnit.update',$ProductTypeUnit):route('ProductTypeUnit.store')}}" method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($ProductTypeUnit)?method_field('PUT'):''}}
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="typeId">Type</label>
                                    <select id="typeId" class="form-control" name="typeId">
                                        @foreach($ProductTypes as $type)
                                            <option value="{{$type->id}}" @if(isset($ProductTypeUnit->productType->id)&&$ProductTypeUnit->productType->id==$type->id)selected @endif>{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="text" name="value" class="form-control"
                                           placeholder="Enter Name" value="@if(old('value')){{old('value')}}@elseif(isset($ProductTypeUnit->value)){{$ProductTypeUnit->value}}@endif" required>
                                </div>
                                <input name="productId" value="{{isset($ProductTypeUnit)?$ProductTypeUnit->productId:$productId}}" hidden  required>


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
