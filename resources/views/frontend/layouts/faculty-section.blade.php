@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

<div class="row" data-aos="zoom-in" data-aos-delay="100">
          @foreach($faculties as $faculty)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="{{asset('/upload/teacher_images/'.$faculty->image)}}" class="img-fluid" alt="">
              <div class="member-content">
                <h4>{{$faculty->name}}</h4>
                <span>{{$faculty->designation}}</span>
                <p>
                 {{$faculty->department}}
                </p>
              </div>
            </div>
          </div>              
         @endforeach
        </div>