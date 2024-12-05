@extends('layouts.client_layout')

@section('content')
<main class="main">

    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">User<span>Transaction History</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaction History</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                @if($data ->count()>0)
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Upgrade Type</th>
                        <th>Total</th>
                        <th>Payment Method</th>
                        <th>Transaction Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $transaction)
                    <tr>
                        <td class="stock-col">{{ $loop->iteration }}</td>
                        <td class="price-col">@if($transaction->channel_id === null)
                            {{ $transaction->upgrade }} <a href="salenew-detail/{{$transaction->sale_news_id }}">ID - {{$transaction->sale_news_id}}</a>
                            @else
                            {{ $transaction->upgrade }}
                            @endif
                        </td>
                        <td class="stock-col">${{ number_format($transaction->amount, 2) }}</td>
                        <td class="action-col">
                            <span class="badge bg-danger">{{ $transaction->payment_method }}</span> -
                            <span class="badge bg-secondary">{{ $transaction->vnp_BankCode }}</span>
                        </td>
                        <td class="remove-col">{{ date('D, d M Y', strtotime($transaction->transaction_date)) }}</td>
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <H4>No transaction history</H4>
                @endif
            </table><!-- End .table table-wishlist -->

        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


@endsection

@section('script-link-css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection