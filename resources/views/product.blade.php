@extends('layouts.admin')
@section('content')
@include('productAddModal')
@include('productEditModal')
<div class="wrapper" id="wrapper">
@include('layouts.Sidebar')
<div id="content">
	@include('layouts.header')

		<!-- DataTales Example -->
		 <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Product Table</h6>
        </div>
          <div class="card shadow mb-4">
          	<button type="button" class="btn btn-primary badge-pill" id="addProductdata" style="margin-left: 2%;margin-top: 10px;width: 94px;">ADD</button>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="prdTable" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#NO</th>
                      <th>Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody id="productTbody">
                    @foreach($productData as $prdDatas)
                    <tr>
                      <td>{{$prdDatas->id}}</td>
                      <td id="name{{$prdDatas->id}}">{{$prdDatas->name}}</td>
                      <td id="quqntity{{$prdDatas->id}}">{{$prdDatas->quantity}}</td>
                      <td id="price{{$prdDatas->id}}">{{$prdDatas->price}}</td>
                      @if($prdDatas->status == 'active')
                      <td class="td-status" id="status"><input data-id="{{$prdDatas->id}}" data-status="{{$prdDatas->status}}" class="btn btn-success btn-status" id="active" type="button" value="active"></td>
                      @else
                      <td class="td-status" id="status"><input data-id="{{$prdDatas->id}}" data-status="{{$prdDatas->status}}" class="btn btn-danger btn-status" id="pause" type="button" value="inactive"></td>
                      @endif
                      <td>
                        <a class="btn-edit" data-id="{{$prdDatas->id}}"><i class="fa fa-edit fa-sm" style="color:blue;"></i></a>
                        <a class="btn-delete" data-id="{{$prdDatas->id}}"><i class="fa fa-trash fa-sm" aria-hidden="true" style="color:red;"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        
@include('layouts.footer')
@endsection