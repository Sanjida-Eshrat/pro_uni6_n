@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp
        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          @foreach($courses as $course)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="course-item">
              <img src="{{asset('/upload/course_images/'.$course->image)}}" class="img-fluid" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h4>{{$course->head_title}}</h4>
                 <!-- <p class="price">$169</p> -->
                </div>

                <h3><a href="course-details.html">{{$course->big_title}}</a></h3>
                <p>{{$course->small_title}}</p>
               
              </div>
            </div>
          </div> <!-- End Course Item-->
          @endforeach
        </div>