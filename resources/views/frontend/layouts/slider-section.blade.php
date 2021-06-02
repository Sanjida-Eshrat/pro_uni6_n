@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-center align-items-center">
    @foreach($sliders as $slider)
    <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
      <h1>{{$slider->long_title}}</h1>
      <h2>{{$slider->short_title}} </h2>
      <a href="{{ route('login') }}" class="btn-get-started">Login</a>
    </div>
    @endforeach
  </section><!-- End Hero -->
