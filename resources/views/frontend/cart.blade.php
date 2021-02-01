@extends('layouts.admin')

@section('content')

<section class="bg-success">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2 py-3">
                <h5><a href="{{route('customer.productList')}}" class="text-dark">Home</a> › Cart</h5>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(isset($cartData))
                    @if(Cookie::get('shopping_cart'))
                        @php $total="0" ; @endphp
                        <div class="shopping-cart">
                            <div class="shopping-cart-table">
                                <div class="table-responsive">
                                    <div class="col-md-12 text-right mb-3">
                                        <a href="javascript:void(0)" class="clear_cart font-weight-bold">Clear Cart</a>
                                    </div>
                                    <form method="POST" id="userDetails" name="userDetails">
                                    <div class="row">
                                        {{ csrf_field() }} 
                                        <div class="col-md-12 text-center mb-3">
                                        <a class="font-weight-bold">Shipping</a>
                                        </div>
                                        <input type="text" name="userName" class="form-control" placeholder="Enter User Name" style="width: 54%;margin-bottom: 3%;margin-left: 24%;" required>
                                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" style="width: 54%;margin-bottom: 3%;margin-left: 24%;">
                                        <input type="text" name="email" class="form-control" placeholder="Enter Phone Email" style="width: 54%;margin-bottom: 3%;margin-left: 24%;">
                                        <textarea name="address" class="form-control" placeholder="Enter Shipping Address" style="width: 54%;margin-bottom: 3%;margin-left: 24%;"></textarea>
                                    </div>
                                    </form>
                                    <table class="table table-bordered my-auto  text-center">
                                        {{ csrf_field() }} 
                                        <thead>
                                            <tr>
                                                <th class="cart-description">Image</th>
                                                <th class="cart-product-name">Product Name</th>
                                                <th class="cart-price">Price</th>
                                                <th class="cart-qty">Quantity</th>
                                                <th class="cart-total">Grandtotal</th>
                                                <th class="cart-romove">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-auto">
                                            @foreach ($cartData as $data)
                                            <input type="hidden" class="product_id" id="prdid{{$data['item_id']}}" value="{{ $data['item_id'] }}" >
                                            <tr class="cartpage">
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail" href="javascript:void(0)">
                                                        <img src="{{ asset('public/images/products/thumb-1.jpg') }}" width="70px" alt="">
                                                    </a>
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'>
                                                        <a href="javascript:void(0)">{{ $data['item_name'] }}</a>
                                                    </h4>
                                                </td>
                                                <td class="cart-product-sub-total">
                                                    <span class="cart-sub-total-price">{{ $data['item_price'] }}</span>
                                                </td>
                                               <td class="cart-product-quantity" width="130px">
                                                <div class="input-group quantity">
                                                    <div class="input-group-prepend changeQuantity decrement-btn" style="cursor: pointer" data-id="{{$data['item_id']}}" data-price="{{ $data['item_price'] }}">
                                                        <span class="input-group-text">-</span>
                                                    </div>
                                                    <input type="text" class="qty form-control" id="qtyinput{{$data['item_id']}}" maxlength="2" max="10" value="{{ $data['item_quantity'] }}">
                                                    <div class="input-group-append changeQuantity increment-btn" style="cursor: pointer" data-id="{{$data['item_id']}}" data-price="{{ $data['item_price'] }}">
                                                        <span class="input-group-text">+</span>
                                                    </div>
                                                </div>
                                                </td>
                                                @php $price = str_replace(',','',$data["item_price"]); @endphp
                                                <td class="cart-product-grand-total">
                                                    <span class="cart-grand-total-price" id="grandtotal{{$data['item_id']}}">{{ number_format($data['item_quantity'] * $price, 2) }}</span>
                                                </td>
                                                <td>
                                                    <button type="button" class="delete_cart_data btn-danger" style="font-size: 15px;" data-id="{{$data['item_id']}}"><li class="fa fa-trash fa-sm" style="color:white;"></li> Delete</button>
                                                </td>
                                                @php $total = $total + ($data["item_quantity"] * $price); @endphp
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table><!-- /table -->
                                </div>
                            </div><!-- /.shopping-cart-table -->
                            <div class="row" style="margin-top: 13px;">

                                <div class="col-md-8 col-sm-12 estimate-ship-tax">
                                    <div>
                                        <a href="{{ route('customer.productList') }}" class="btn btn-upper btn-warning outer-left-xs">Continue Shopping</a>
                                    </div>
                                </div><!-- /.estimate-ship-tax -->

                                <div class="col-md-4 col-sm-12 ">
                                    <div class="cart-shopping-total">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="cart-subtotal-name">Subtotal</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="cart-subtotal-price">
                                                    Rs.
                                                    <span class="cart-grand-price-viewajax">{{ number_format($total, 2) }}</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="cart-grand-name">Grand Total</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="cart-grand-price">
                                                    Rs.
                                                    <span class="cart-grand-price-viewajax">{{ number_format($total, 2) }}</span>
                                                </h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="cart-checkout-btn text-center">
                                                    @if (Auth::user())
                                                        <a href="{{ url('checkout') }}" class="btn btn-success btn-block checkout-btn" id="checkoutBtn" style="margin-bottom: 12px;">PROCCED TO CHECKOUT</a>
                                                    @else
                                                        <a href="{{ url('login') }}" class="btn btn-success btn-block checkout-btn" style="margin-bottom: 12px;">PROCCED TO CHECKOUT</a>
                                                        {{-- you add a pop modal for making a login --}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.shopping-cart -->
                    @endif
                @else
                    <div class="row">
                        <div class="col-md-12 mycard py-5 text-center">
                            <div class="mycards">
                                <h4>Your cart is currently empty.</h4>
                                <a href="{{ route('customer.productList') }}" class="btn btn-upper btn-primary outer-left-xs mt-5">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div> <!-- /.row -->
    </div><!-- /.container -->
</section>
@endsection
