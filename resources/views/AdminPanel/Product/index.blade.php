@extends('AdminPanel.layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{route('Product.create')}}">Create</a>
            </h3>
        </div>
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            @include('AdminPanel.layouts.messages')
            @if(count($Products) > 0)
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>English Name</th>
                        <th>Arabic Name</th>
                        <th>Stock</th>
                        <th>image</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Products as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td >{{$item->name}}</td>
                            <td >{{$item->nameAr}}</td>
                            <td >{{$item->stock}}</td>
                            @if(isset($item->productImage->image))
                            <td><img src="{{url($item->productImage->image)}}" width="150" height="100"></td>
                            @endif
                            <td>
                                <a class="btn btn-primary " href="{{route('Product.show',$item)}}">Show</a>
                                <a  style="color: #ffffff" href="{{route('changeStatusProduct',$item)}}" class="btn {{($item->isActive)?'btn-danger':'btn-primary'}} text-center">{{($item->isActive)?'Set Hide':'set Active'}}</a>

                                <a class="btn btn-dark " href="{{route('Product.edit',$item)}}">Edit</a>
                                <form  class=""  action="{{route("Product.destroy", $item)}}" method="post"
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
                        <th>English Name</th>
                        <th>Arabic Name</th>
                        <th>Stock</th>
                        <th>image</th>
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
