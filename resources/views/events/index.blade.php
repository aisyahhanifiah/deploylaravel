@extends('layouts.app')

@section('title', 'Events |')

{{-- @section('pagename')
{{ Breadcrumbs::render('event.index') }}
@endsection --}}

@section('content')

<div class="header pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      {{ Breadcrumbs::render('event.index') }}
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row pb-4 pl-2">
    <div class="col-md-5 ">
      <div class="input-group ">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
        <input class="form-control search" onkeyup="myFunction()" id="myInput" placeholder="Search" type="text">
      </div>     
    </div>
    
  </div>
  <div class="row pb-5 pl-2">
    <div class="col-md-10 ">
      <span id="btn-group">
        <i class="fas fa-filter px-3"></i>
        <button class="btn btn-success active filter-button my-2" data-filter="all" id="all">All</button>
        <button class="btn btn-primary filter-button my-2" data-filter="f1" id="social">Social</button>
        <button class="btn btn-primary filter-button my-2" data-filter="f2" id="career">Career</button>
        <button class="btn btn-primary filter-button my-2" data-filter="f3" id="emotional">Emotional</button>
        <button class="btn btn-primary filter-button my-2" data-filter="f4" id="intellectual">Intellectual</button>
        <button class="btn btn-primary filter-button my-2" data-filter="f5" id="physical">Physical</button>
        <button class="btn btn-primary filter-button my-2" data-filter="f6" id="spiritual">Spiritual</button>
      </span>
    </div>
  </div>
  <div class="row align-items-center" id="myDIV">
    @foreach($events as $key => $event)
    <div class="col-lg-3 col-xl-4 col-md-12 filter f{{$event->domain_id}}" id="card">
      <div class="card mb-3">
        <div id="carouselExampleControls{{$event->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($event->images as $key => $images)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
              <img class="card-img-top" src="{{ asset('img/event/'.$images->filename) }}" alt="ss">
            </div>
            @endforeach
          </div>
          @if($event->images->count() > 1)
          <a class="carousel-control-prev" href="#carouselExampleControls{{$event->id}}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls{{$event->id}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          @endif
        </div>
        

        <div class="card-body">
          @foreach ($users->events as $events)

          @if($events->id == $event->id)
          <a href="#" class="btn btn-sm btn-success disabled">Joined</a><br><br>
          @endif

          @endforeach
          <div>
              <h4 class="card-title">{{ $event->name }}</h4>
          </div>
          <div>
              <span class="description">{{ Carbon\Carbon::parse($event->start_date)->format('l, dS F Y') }}</span>
          </div>
          <div>
              <span class="description">{{ $event->venue }}</span>
          </div>
          <br>
          <p class="card-text text-truncate">{{ $event->description }}</p>
          <a href="{{ route('event.show',$event->id)}}" class="btn btn-primary">Show more</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @include('layouts.footers.auth')
</div>
@section('loadlist')
<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
    // var repeat = document.getElementById("card");
    var value = $(this).val().toLowerCase();
    $("#myDIV  #card ").filter(function() {
      // if ($(this).text().toLowerCase().indexOf(value) > -1) {
      //   repeat.style.display = "";
      // } else {
      //   repeat.style.display = "none";
      // }
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    $(".filter-button").click(function(){
      var value = $(this).attr('data-filter');

      if(value == "all")
      {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
          }
          else
          {
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
          }
          $(this).siblings().removeClass('active')
          $(this).addClass('active');
        });

  });

</script>
@endsection
@endsection