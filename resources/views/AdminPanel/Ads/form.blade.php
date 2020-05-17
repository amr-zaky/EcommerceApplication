@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{isset($Ad)?'Edit '.$Ad->name :'ADD'}}</li>
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
                        <form action="{{(isset($Ad))?route('Ad.update',$Ad):route('Ad.store')}}" method="post"
                              enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($Ad)?method_field('PUT'):''}}

                            <div class="card-body">


                                @if(isset($Ad))
                                    <div class="form-group text-center">


                                        @if($Ad->mediaType=='image')

                                            <img style="width: 500px;height: 250px;" src="{{url($Ad->mediaUrl)}}">

                                        @else

                                                <video muted="" width="90%" height="500px" id="video_player"
                                                       controls="controls" autoplay="" poster="" style="outline: none">
                                                    <source id="video_mp4" src="{{url($Ad->mediaUrl)}}"
                                                            type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
                                                </video>

                                        @endif
                                    </div>
                                @endif


                                <div class="form-group">
                                    <label for="itemId">Product</label>

                                    <select id="itemId" class="form-control" name="itemId">
                                        @foreach($productData as $product)
                                            <option value="{{$product->id}}"
                                                    @if(isset($Ad->product->id)&& $Ad->product->id==$product->id)selected @endif>{{$product->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                    <input name="itemType" value="product" hidden>
                                </div>

                                <div class="form-group">
                                    <label for="mediaType">Ad Type</label>
                                    <select name="mediaType" class="form-control">
                                        <option value="video"
                                                @if(isset($Ad->mediaType)&& $Ad->mediaType=='video')selected @endif>
                                            Video
                                        </option>
                                        <option value="image"
                                                @if(isset($Ad->mediaType)&& $Ad->mediaType=='image')selected @endif>
                                            Image
                                        </option>
                                    </select>
                                    <input name="itemType" value="product" hidden>
                                </div>


                                <div class="form-group">
                                    <label for="mediaUrl">Image /Video</label>
                                    <input type="file" class="form-control" name="mediaUrl"
                                           @if(!isset($Ad))required @endif>
                                    <br>
                                    @if(isset($Ad->image))
                                        <img src="{{url($Ad->image)}}" width="250" height="250">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="startDate">start Date</label>
                                    <input type="date" class="form-control" name="startDate"
                                           value="@if(old('startDate')){{old('startDate')}}@elseif(isset($Ad->startDate)){{$Ad->startDate}}@endif">
                                </div>

                                    <div class="form-group">
                                        <label for="endDate">End Date</label>
                                        <input type="date" class="form-control" name="endDate"
                                               value="@if(old('endDate')){{old('endDate')}}@elseif(isset($Ad->endDate)){{$Ad->endDate}}@endif">
                                    </div>

                                <div class="form-group">
                                    <label for="viewOrder">View Order</label>
                                    <input type="number" class="form-control" name="viewOrder"
                                           value="@if(old('viewOrder')){{old('viewOrder')}}@elseif(isset($Ad->viewOrder)){{$Ad->viewOrder}}@endif">
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
