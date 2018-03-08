<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ app()->getLocale() }}">
<head>
<title>  @yield('title') </title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{URL::asset('asset/js/bootstrap.min.js')}}"></script>

<script type="text/javascript" src="/catastrophes-system-web/faces/javax.faces.resource/bootstrap-lightbox/ekko-lightbox.min.js"></script>
<link href="{{ asset ('css/slideShow.css')}}"                       rel="stylesheet" type="text/css" />
<link href="{{ asset('css/SecStyleSheet.css')}}"                    rel="stylesheet" type="text/css" />
<link href="{{ asset ('css/style.css')}}"                           rel="stylesheet" type="text/css" />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="{{URL::asset('asset/js/bootstrap.min.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src= "{{ asset ('js/slideShow.js')}}"               type="text/javascript" ></script>
<script src="{{ asset ('js/cufon.js')}}"             type="text/javascript" ></script>
<script src="{{ asset ('js/arial.js')}}"                 type="text/javascript" ></script>
<script src="{{ asset ('js/cuf_run.js')}}"      type="text/javascript" ></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body onload="showSlides();" >
<!-- START PAGE SOURCE -->

<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.html"><span>PGM</span>C <small>College of Medicine</small></a></h1>
      </div>
      <div class="menu_nav">
        <ul>
          @guest
          <li><a href="#">Home</a></li>
          <li ><a href="#">KSU Programs</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Login</a></li>
          @else
  <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                     </li>
                                </ul>
                            </li>
                        @endguest
        </ul>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  
  
  
    <div class="content_resize">
  
    <div class="slideshow-container">

     <div class="mySlides fade">
     <div class="numbertext"></div>
     <img src="{{ asset('images/b1.jpg')}}" style="width:100%"  height="191px">
     <div class="text">Caption Text</div>
     </div>

     <div class="mySlides fade">
     <div class="numbertext"></div>
     <img src="{{ asset('images/b2.jpg')}}" style="width:100%"  height="191px">
     <div class="text">Caption Two</div>
     </div>

     <div class="mySlides fade">
     <div class="numbertext"></div>
     <img src="{{ asset('images/b3.png')}}" style="width:100%"  height="191px">
     <div class="text">Caption Three</div>
     </div>

    </div>
  

    <div style="text-align:center">
     <span class="dot"></span> 
     <span class="dot"></span> 
     <span class="dot"></span> 
    </div>

    </div>
  
  
  
  
<div class="content">
<div class="content_resize">

  @yield('content')
</div>

  <div class="fbg">
    <div class="fbg_resize">
      <div class="clr"></div>
    </div>
  </div>

  <div class="footer">
    <div class="footer_resize">
      <p class="lf">Copyright &copy; 2010 <a href="#">SiteName</a> - All Rights Reserved</p>
      <p class="rf">Design by <a href="http://www.iwebsitetemplate.com/">I Website Template</a></p>
      <div class="clr"></div>
    </div>
  </div>


  </div>

</body>
</html>
