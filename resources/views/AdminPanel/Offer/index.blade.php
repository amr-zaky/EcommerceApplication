@extends('AdminPanel.layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{route('Offer.create')}}">Create</a>
            </h3>
        </div>
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            @include('AdminPanel.layouts.messages')
            @if(count($Offers) > 0)
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price Before</th>
                        <th>Price After</th>
                        <th>Discount</th>
                        <th>Discount Type</th>
                        <th>Status</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Offers as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td ><a href="{{route('Product.show',$item->productWeb)}}">{{$item->productWeb->name}}</a></td>
                            <td >{{$item->priceBefore}}</td>
                            <td >{{$item->priceAfter}}</td>
                            <td >{{$item->discountAmount}}</td>
                            <td >{{$item->type}}</td>
                            <td> <a  style="color: #ffffff" href="{{route('changeStatusOffer',$item)}}" class="btn {{($item->isActive)?'btn-danger':'btn-primary'}} text-center">{{($item->isActive)?'Set Hide':'set Active'}}</a></td>
                            <td>
                                <a class="btn btn-dark" href="{{route('Offer.edit',$item)}}">Edit</a>
                                <form action="{{route("Offer.destroy", $item)}}" method="post"
                                      style="display:inline;">
                                    @csrf
                                    @method('delete')
                                    <button type="button" id="btnDelete" class="btn btn-danger btn-delete">Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price Before</th>
                        <th>Price After</th>
                        <th>Discount</th>
                        <th>Discount Type</th>
                        <th>Status</th>
                        <th>Control</th>
                    </tr>
                    </tfoot>
                </table>
            @else
                <h1 class="text-center">NO DATA</h1>
            @endif
        </div>
        <!-- /.card-body -->
    </div>
@endsection
