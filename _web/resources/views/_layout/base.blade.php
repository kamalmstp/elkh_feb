<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>e - LKH & SKP FEB</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link href="{{ asset('img/logo.png') }}" rel="shortcut icon">

  @section('css')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
            rel="stylesheet">
  @show
</head>

<body>

@include('_layout.navbar')

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">        

        @yield('content')
        
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->

<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2018 <a href="#">Fakultas Ekonomi dan Bisnis ULM</a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 

<!-- Le javascript
================================================== --> 
@section('js')
  <script src="{{ asset('js/jquery-1.7.2.min.js') }}"></script> 
  <script src="{{ asset('js/excanvas.min.js') }}"></script> 
  <script src="{{ asset('js/bootstrap.js') }}"></script> 
  <script src="{{ asset('js/base.js') }}"></script> 
@show

</body>
</html>
