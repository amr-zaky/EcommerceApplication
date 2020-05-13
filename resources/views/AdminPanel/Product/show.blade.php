@extends('AdminPanel.layouts.main')
@section('content')
    <style>
        .checked {
            color: orange;
        }
    </style>
    <div class="card container">
        <div class="page-title">
            <div class="title_left">
                <h3><i class="fa fa-hospital-o"></i> <a href="{{route('adminDashboard')}}">Home</a> / View

                </h3>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('AdminPanel.layouts.messages')
                    <table class="table table-hover table-striped">
                        <tbody>
                        <tr>
                            <th>English Name</th>
                            <td>{{$Product->name}}</td>
                        </tr>

                        <tr>
                            <th>Arabic Name</th>
                            <td>{{$Product->nameAr}}</td>
                        </tr>

                        <tr>
                            <th>English Description</th>
                            <td>{{$Product->description}}</td>
                        </tr>

                        <tr>
                            <th>Arabic Description</th>
                            <td>{{$Product->descriptionAr}}</td>
                        </tr>

                        <tr>
                            <th>SubCategory Name</th>
                            @if(isset($Product->subCategory->name))
                                <td>{{$Product->subCategory->name}}</td>
                            @endif
                        </tr>

                        <tr>
                            <th>Price</th>
                            <td>{{$Product->price}}</td>
                        </tr>

                        <tr>
                            <th>Supplier Name</th>
                            @if(isset($Product->supplier->name))
                                <td>{{$Product->supplier->name}}</td>
                            @endif
                        </tr>

                        <tr>
                            <th>Stock</th>
                            <td>{{$Product->stock}}</td>
                        </tr>

                        <tr>
                            <th>Sold Count</th>
                            <td>{{$Product->soldCount}}</td>
                        </tr>
                        <tr>
                            <th>Control</th>
                            <td>
                                <a href="{{route('Product.edit',$Product)}}"
                                   class="btn  btn-primary">Edit</a>
                                <a href="{{route('ProductTypeUnit.create',['productId'=>$Product->id])}}"
                                   class="btn  btn-danger">Add Product Unit</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <!-- start-->
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <div class="x_panel parent">
                        <div class="x_content">
                            <div class="card container">
                                <h1 style="font-weight: bold;color: #1d68a7">Product Images</h1>
                            </div>
                        </div>
                        <div class="table-responsive text-center">
                            <table class="table table-hover table-striped table-bordered">
                                <tbody>

                                @foreach($Product->productsImages as $ProductImage)
                                    <tr>
                                        <td><img src="{{(!empty($ProductImage))?url($ProductImage->image):''}}"
                                                 width="150" height="150"></td>

                                        <td class="text-center delete-table">
                                            <form action="{{route("deleteProductImage",[$ProductImage])}}"
                                                  method="post" style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger btn-delete">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-->

            <!-- start-->
            <div class="col-md-10 col-sm-10 col-xs-10">
                <div class="x_panel parent">
                    <div class="x_content">
                        <div class="card container">
                            <h1 style="font-weight: bold;color: #1d68a7">Product KeyWords</h1>
                        </div>

                        <div class="table-responsive text-center">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th>English Name</th>
                                    <th>Arabic Name</th>
                                    <th>Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Product->productKeyword as $item)
                                    <tr>

                                        <td>{{$item->keyword}}</td>
                                        <td>{{$item->keywordAr}}</td>
                                        <td>
                                            <form class="" action="{{route("deleteProductKeyword", $item)}}"
                                                  method="post"
                                                  style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" id="btnDelete" class="btn btn-danger btn-delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-->

            <!-- start-->
            <div class="col-md-10 col-sm-10 col-xs-10">
                <div class="x_panel parent">
                    <div class="x_content">
                        <div class="card container">
                            <h1 style="font-weight: bold;color: #1d68a7">Product Rate</h1>
                        </div>

                        <div class="table-responsive text-center">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                <tr>

                                    <th>Rate</th>
                                    <th>Comment</th>
                                    <th>Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Product->rate as $item)
                                    <tr>

                                        <td>{{$item->rate}} <span class="fa fa-star checked"></span></td>
                                        <td>{{$item->comment}}</td>
                                        <td>
                                            <form class="" action="{{route("deleteProductRate", $item)}}" method="post"
                                                  style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" id="btnDelete" class="btn btn-danger btn-delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-->

            <!-- start-->
            <div class="col-md-10 col-sm-10 col-xs-10">
                <div class="x_panel parent">
                    <div class="x_content">
                        <div class="card container">
                            <h1 style="font-weight: bold;color: #1d68a7">Product Unites</h1>
                        </div>

                        <div class="table-responsive text-center">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>English Name</th>
                                    <th>Arabic Name</th>
                                    <th>English Value</th>

                                    <th>Control</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Product->productUnits as $item)
                                    <tr>
                                       <td>{{$item->productType->name}}</td>
                                       <td>{{$item->productType->nameAr}}</td>
                                        <td>{{$item->value}}</td>
                                        <td>
                                            <a href="{{route('ProductTypeUnit.edit',$item)}}"
                                               class="btn  btn-primary">Edit</a>
                                            <form class="" action="{{route("ProductTypeUnit.destroy", $item)}}" method="post"
                                                  style="display:inline;">
                                                @csrf
                                                @method('delete')
                                                <button type="button" id="btnDelete" class="btn btn-danger btn-delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end-->
        </div>
    </div>
@endsection
