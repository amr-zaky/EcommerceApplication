@extends('AdminPanel.layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{route('Supplier.create')}}">Create</a>
            </h3>
        </div>
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            @include('AdminPanel.layouts.messages')
            @if(count($Suppliers) > 0)
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>English Name</th>
                        <th>Arabic Name</th>
                        <th>English Title</th>
                        <th>Arabic Title</th>
                        <th>Phone</th>
                        <th>image</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Suppliers as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td >{{$item->name}}</td>
                            <td >{{$item->nameAr}}</td>
                            <td >{{$item->title}}</td>
                            <td >{{$item->titleAr}}</td>
                            <td >{{$item->phone}}</td>
                            <td><img src="{{url($item->image)}}" width="150" height="100"></td>
                            <td>
                                <a class="btn btn-dark" href="{{route('Supplier.edit',$item)}}">Edit</a>
                                <form action="{{route("Supplier.destroy", $item)}}" method="post"
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
                        <th>English Title</th>
                        <th>Arabic Title</th>
                        <th>Phone</th>
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
