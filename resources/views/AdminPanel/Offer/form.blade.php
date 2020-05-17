@extends('AdminPanel.layouts.main')
@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">{{isset($Offer)?'Edit '.$Offer->name :'ADD'}}</li>
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
                        <form action="{{(isset($Offer))?route('Offer.update',$Offer):route('Offer.store')}}"
                              method="post" enctype="multipart/form-data">
                            @include('AdminPanel.layouts.messages')
                            @csrf
                            {{isset($Offer)?method_field('PUT'):''}}
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="productId">Product</label>

                                    <select id="productId" class="form-control" name="productId">
                                        @foreach($productData as $product)
                                            <option value="{{$product->id}}"
                                                    @if(isset($Offer->productWeb->id)&& $Offer->productWeb->id==$product->id)selected @endif>{{$product->name}}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Type">Type</label>
                                    <select name="type" class="form-control">
                                        <option value="amount" @if(isset($Offer->type)&& $Offer->type=='amount')selected @endif>Amount</option>
                                        <option value="percentage" @if(isset($Offer->type)&& $Offer->type=='percentage')selected @endif>Percentage</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="number" class="form-control" name="discountAmount"
                                           value="@if(old('discountAmount')){{old('discountAmount')}}@elseif(isset($Offer->discountAmount)){{$Offer->discountAmount}}@endif" required>
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
