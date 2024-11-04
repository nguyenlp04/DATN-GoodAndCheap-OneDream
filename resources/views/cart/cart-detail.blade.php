@extends('layouts.client_layout')
@section('content')

<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <table id="cart-table" class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($carts as $item )

                                <tr id="cart-item-{{ $item->cart_id }}">
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{ asset($item->product->firstImage->image_name) }}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="#">{{ $item->product->name_product }}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">${{$item->product->price }}</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity">
                                            <input type="number" class="form-control" value="{{  $item->stock }}" min="1" max="10" step="1" data-decimals="0" id="stock-{{ $item->cart_id }}">
                                        </div><!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col" id="total-col-{{ $item->cart_id }}">${{ number_format($item->stock * $item->product->price, 2) }}</td>
                                    <td id="remove-col-{{ $item->cart_id }}" class="remove-col" data-id="{{ $item->cart_id }}"><button class="btn-remove" data-id="{{ $item->cart_id }}"><i class="icon-close"></i></button></td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table><!-- End .table table-wishlist -->

                        <div class="cart-bottom">
                            <div class="cart-discount">

                                <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                            </div><!-- End .cart-discount -->
                            {{-- <a href="#" class="btn btn-outline-dark-2"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a> --}}
                        </div><!-- End .cart-bottom -->
                    </div><!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td id="total-value"></td>
                                    </tr><!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>


                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="standart-shipping" name="shipping" class="custom-control-input" value="10" checked>
                                                <label class="custom-control-label" for="standart-shipping">Standart:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$10.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="express-shipping" name="shipping" class="custom-control-input" value="20">
                                                <label class="custom-control-label" for="express-shipping">Express:</label>
                                            </div><!-- End .custom-control -->
                                        </td>
                                        <td>$20.00</td>
                                    </tr><!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-estimate">
                                        <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                                        <td>&nbsp;</td>
                                    </tr><!-- End .summary-shipping-estimate -->

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td id="total-all">$160.00</td>
                                    </tr><!-- End .summary-total -->
                                </tbody>
                            </table><!-- End .table table-summary -->

                            <a href="checkout.html" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                        </div><!-- End .summary -->


                    </aside><!-- End .col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cart -->
    </div><!-- End .page-content -->
</main><!-- End .main -->


@endsection

@section('script-link-css')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.elevateZoom.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script>


    $(document).ready(function() {
        function calculateTotal() {
            var total = 0;
            $('[id^="total-col-"]').each(function() {
                var priceText = $(this).text().replace('$', '');
                var price = parseFloat(priceText);
                total += price;
            });
            $('#total-value').text('$' + total.toFixed(2));
            var shipping = $('input[name="shipping"]:checked').val();
            if (shipping) {
                total += parseFloat(shipping);
            }

            $('#total-all').text('$' + total.toFixed(2));
        }

        calculateTotal();


        $('[id^="stock-"]').on('change', function() {
            var cartId = $(this).attr('id').split('-')[1];
            var stock = $(this).val();

            $.ajax({
                url: '{{ route("cart.updateStock") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cart_id: cartId,
                    stock: stock
                },
                success: function(response) {
                    if (response.success) {
                        var price = parseFloat(response.previous_stock * response.price);
                        // $(`#total-col-${cartId}`).html('');
                        $(`#total-col-${cartId}`).html('$' + (price).toFixed(2));
                        calculateTotal();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });
        $('input[name="shipping"]').on('change', function() {
            calculateTotal();
        });




            $('[id^="remove-col-"]').each(function() {
                $(this).on('click', function() {
                var cartId = $(this).data('id');
                console.log(cartId);


                $.ajax({
                    url: '{{ route("cart.removeItem") }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cart_id: cartId
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`#cart-item-${cartId}`).remove();
                            calculateTotal();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });
        });
    });
</script>
@endsection
