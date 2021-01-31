@extends('layouts.admin')
@section('content')
<div class="wrapper" id="wrapper">
@include('layouts.Sidebar')
<div id="content">
	@include('layouts.header')
		<!-- DataTales Example -->
		 <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Order Table</h6>
        </div>
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="prdTable" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>PhoneNo</th>
                      <th>Email</th>
                      <th>Product</th>
                      <th>Total</th>
                      <th>Payment Status</th>
                    </tr>
                  </thead>
                  <tbody id="productTbody">
                    @foreach($getorderdetails as $ordDatas)
                    <tr>
                      <td>{{$ordDatas->user_name}}</td>
                      <td data-toggle="tooltip" data-placement="top" title="{{$ordDatas->shipping_address}}"><span class="special-request" style="text-overflow: ellipsis;overflow: hidden;width: 100%;display: block;white-space: nowrap;max-width: 150px;">{{$ordDatas->shipping_address}}</span></td>
                      <td>{{$ordDatas->contact_no}}</td>
                      <td>{{$ordDatas->email}}</td>
                      <td>{{$ordDatas->name}}</td>
                      <td>{{$ordDatas->total}}</td>
                      <td>{{$ordDatas->payment_status}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>   
@include('layouts.footer')
@endsection