@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <img src="{{(!empty($logo->image))?url('/upload/logo_images/'.$logo->image):url('/upload/d.png')}}" height="36" width="36" style="margin-right: 10px;">
      <h1 class="logo mr-auto"><a href="index.html"> IST</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="{{ route('frontend.home') }}">Home</a></li>
          <li><a href="{{ route('front-about-us.view') }}">About</a></li>
          <li><a href="{{route('front-courses.view')}}">Courses</a></li>
          <li><a href="{{route('front-faculty.view')}}">Faculty Members</a></li>
          <li><a href="{{ route('front-events.view') }}">Events</a></li>
          <li><a href="{{ route('front-contacts.view') }}">Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->

      <a href="{{ route('login') }}" class="get-started-btn">Login</a>

    </div>
  </header><!-- End Header -->