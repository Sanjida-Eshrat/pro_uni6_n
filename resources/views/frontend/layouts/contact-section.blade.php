@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

  <div class="info">
    @foreach($contacts as $contact)
      <div class="address">
         <i class="icofont-google-map"></i>
         <h4>Location:</h4>
         <p>{{$contact->location}}</p>
      </div>

      <div class="email">
         <i class="icofont-envelope"></i>
         <h4>Email:</h4>
         <p>{{$contact->email}}</p>
      </div>

      <div class="phone">
         <i class="icofont-phone"></i>
         <h4>Call:</h4>
         <p>{{$contact->phone}}</p>
      </div>
     @endforeach
  </div>
