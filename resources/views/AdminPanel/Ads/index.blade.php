@extends('AdminPanel.layouts.main')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-danger" href="{{route('Ad.create')}}">Create</a>
            </h3>
        </div>
    </div>
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            @include('AdminPanel.layouts.messages')
            @if(count($Ads) > 0)
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Media</th>
                        <th>Media Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Display Order</th>
                        <th>Status</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Ads as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            @if($item->mediaType=='image')
                                <td><img style="width: 200px;height: 100px;" src="{{url($item->mediaUrl)}}"></td>
                            @else
                                <td> <video muted="" width="200" height="100px" id="video_player" controls="controls" autoplay="" poster="" style="outline: none">
                                        <source id="video_mp4" src="{{url($item->mediaUrl)}}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
                                    </video></td>
                            @endif

                            <td >{{$item->mediaType}}</td>
                            <td >{{$item->startDate}}</td>
                            <td >{{$item->endDate}}</td>
                            <td >{{$item->viewOrder}}</td>
                            <td><a  style="color: #ffffff" href="{{route('changeStatusAd',$item)}}" class="btn {{($item->isActive)?'btn-danger':'btn-primary'}} text-center">{{($item->isActive)?'Set Hide':'set Active'}}</a></td>
                            <td>
                                <a class="btn btn-dark" href="{{route('Ad.edit',$item)}}">Edit</a>
                                <form action="{{route("Ad.destroy", $item)}}" method="post"
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
                        <th>Media</th>
                        <th>Media Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Display Order</th>
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
