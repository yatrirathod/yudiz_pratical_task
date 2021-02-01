@extends('layouts.admin')
@section('content')


<style>
  .badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
#lblCartCount {
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px; 
}
  </style>
<div class="wrapper" id="wrapper">
<div id="content">
    @include('layouts.customerHeader')
    <div style="float: right; cursor: pointer;">
        <a href="{{ route('viewcart') }}"><i class="fa" style="font-size:24px;">&#xf07a;</i>
        <span class='badge badge-warning' id='lblCartCount'>0</span></a>
    </div>
         <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Products</h6>
        </div>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <div class="container">
                    <div class="row product_data">
                        @foreach($productData as $prd)
                        <div class="col-md-4">
                            <img src="{{ asset('/public/images/products/thumb-1.jpg') }}" class="w-100" alt="Product 1" style="height: 50%; width:25%;">
                            <h4>{{$prd->name}}</h4><p class="card-text">Rs-{{$prd->price}}</p>
                            <input type="hidden" class="product_id{{$prd->id}}" value="{{$prd->id}}"> <!-- Your Product ID -->
                            <input type="text" class="qty-input{{$prd->id}}" value="1"><!-- Your Number of Quantity -->
                            <button type="button" class="add-to-cart-btn btn btn-primary" data-id="{{$prd->id}}">Add to Cart</button>
                        </div>
                        @endforeach
                      {{ $productData->links() }}
                    </div>
                </div>
              </div>
            </div>
          </div>
        


@endsection