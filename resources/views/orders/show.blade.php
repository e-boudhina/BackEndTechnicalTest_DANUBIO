@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card" style="width: 100%">

            <div class="card-header">
                <h3 class="float-start">Items :</h3>
                <div class="float-end">
                   <a class="btn btn-outline-dark float-right mr-1  btn-sm " href="{{ route('order.index') }}"> Go Back</a>

                </div>
            </div>
            <div class="card-body">
                @include('inc.feedback')

                    <table class="table table-striped">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Item Index</th>
                            <th scope="col">Item ID</th>
                            <th scope="col">Item Quantity </th>
                            <th scope="col">Line Price Excluding VAT</th>
                            <th scope="col">Line Price Including VAT</th>
                            <th scope="col">Requested At</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($items as $item)
                            <tr >

                                <td>{{$item->item_index? $item->item_index: 'N/A'}}</td>
                                <td>{{$item->item_id? $item->item_id: 'N/A'}}</td>
                                <td>{{$item->item_quantity? $item->item_quantity: 'N/A'}}</td>
                                <td>{{$item->line_price_exl_vat? $item->line_price_exl_vat: 'N/A'}}</td>
                                <td>{{$item->line_price_incl_vat? $item->line_price_incl_vat: 'N/A'}}</td>
                                <td>
                                    {{$item->created_at? $item->created_at->diffForHumans(): 'N/A'}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                <div class="pagination float-end">
                    <div class="row justify-content-between" id="pagination">
                        <div id="items-pagination" class="col-md-8">
                            <span>Showing {{$items->firstItem()}} to {{$items->lastItem()}}  of {{$items->total()}} entries</span>
                        </div>
                        {{$items->links()}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
