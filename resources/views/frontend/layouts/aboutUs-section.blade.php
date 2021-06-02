
@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
<!-- ======= About Section ======= -->
    @foreach($aboutuses as $aboutus)
        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="{{asset('/upload/aboutus_images/'.$aboutus->image)}}" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>{{$aboutus->head_title}}</h3>
            <p class="font-italic">
              {{$aboutus->first_part}}
            </p>
            <p>
              {{$aboutus->second_part}}
            </p>
            <a href="about.html" class="learn-more-btn">Learn More</a>
          </div>
        </div>
        @endforeach
    <!-- End About Section -->