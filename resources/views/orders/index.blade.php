@extends('layouts.app')

@section('content')
    <div class="container" id="content">
        <div class="card"  style="width: 100%">

            <div class="card-header">

                <h3 class="float-start">Processed Orders :</h3>
                <div class="float-end">
                    <div class="btn-group">

                                    <div class="col" >
                                            <a class="btn btn-success btn me-2" id="btn" href="{{ route('order.to-csv')}}">Pull Orders</a>
                                    </div>

                        @if( count($orders) > 0)
                            <div class="col">
                                    <form method="post" action="{{ route('order.delete-all') }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete All Orders</button>
                                        </form>
                            </div>
                        </div>
                                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('inc.feedback')

                @if( count($orders) >0 )

                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Number</th>
                            <th scope="col">Number of Items </th>
                            <th scope="col">Created</th>
                            <th scope="col">Last Updated</th>
                            <th scope="col">Actions</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $key => $order)
                            <tr >
                                <td>{{$key+1}}</td>
                                <td>{{$order->order? $order->order: 'N/A'}}</td>
                                <td>{{$order->items_count? $order->items_count: 'N/A'}}</td>
                                <td>
                                    {{$order->created_at? $order->created_at->diffForHumans(): 'N/A'}}
                                </td>
                                <td>
                                {{$order->updated_at? $order->updated_at->diffForHumans(): 'N/A'}}
                                <td>
                                    <div class="btn-group">
                                        <div class="col">
                                            <a class="btn btn-info btn-sm me-2 " href="{{ route('order.show',$order->order) }}">View</a>
                                        </div>
                                        <div class="col">
                                        <form method="post" action="{{ route('order.destroy',$order->order) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <h3 class="text-center">There Are No Orders Yet</h3>
                @endif

    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $( "#btn" ).on( "click", function() {
            setTimeout(function(){
                window.location.reload(1);
            },2000);
        } );
    </script>
@endsection
