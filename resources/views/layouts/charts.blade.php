@extends('layouts.admin')

@section('content')
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
#piechartdiv {
    width: 100%;
  height: 500px;
}
</style>
      <!-- Main Content -->
      <div id="wrapper">
        @include('layouts.sidebar')
      <div id="content">
        @include('layouts.header')
        <!-- Begin Page Content -->
        <div class="container-fluid">
          
          <div class="row">
            <!-- <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
            <link rel="stylesheet" href="https://www.cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
            <link href="{{ asset('public/css/morish.css') }}" rel="stylesheet">

            <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
  
            <div class="col-md-12">
              <p class="text-center" style="color:black;"><b>Line Chart For Accounts</b></p>
              <div id="line-chart"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="text-center" style="color:black;"><b>Bar Chart for Accounts</b></p>
              <div id="bar-chart"></div>
            </div>  
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="text-center" style="color:black;"><b>Pie Chart for Accounts</b></p>
              <div id="donut-chart"></div>
            </div>  
          </div>
          <div class="row">
            <div class="col-md-12">
              <div id="chartdiv"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div id="piechartdiv"></div>
            </div>
          </div>
      </div>
      
        <!-- /.container-fluid -->
        @include('layouts.footer')
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
        <script src="https://www.amcharts.com/lib/3/serial.js"></script>
        <script src="http://www.amcharts.com/lib/3/pie.js"></script>
        <script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
        <script src="{{ asset('public/js/morish.js')}}" type="text/javascript"></script>
        
@endsection