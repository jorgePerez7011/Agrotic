@extends('layouts.app')

@section('title', 'Bill')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-12 text-right">
                       
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-6">
                        Date: {{ $order->date_order }}
                        <br>
                        Total: ${{ $order->total }}
                    </div>
                    <div class="col-6">
                        Client: {{ $client->name }}
                        <br>
                        Document: {{ $client->document }}
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead style="background-color: #047857; color: white;">
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        @foreach ($details as $detail)
                            <tr>
                                <th>{{ $detail->product->name }}</th>
                                <th> ${{ $detail->product->price }} </th>
                                <th> {{ $detail->quantity }} </th>
                                <th>${{ $detail->product->price * $detail->quantity }}</th>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
