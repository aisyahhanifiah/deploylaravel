@extends('layouts.app')

@section('title', 'Clubs |')

@section('pagename', 'Clubs')

@section('content')
<div class="header pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      {{ Breadcrumbs::render('club.index') }}
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
  <div class="row align-items-center " id="myDIV">
    @foreach($clubs as $key => $club)
    <div class="col-lg-3 col-xl-4 col-md-12 filter f{{$club->domain_id}}" id="card">
      <div class="card mb-3" >
        <div id="carouselExampleControls{{$club->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($club->images as $key => $images)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
              <img class="card-img-top" src="{{ asset('img/club/'.$images->filename) }}" alt="ss">
            </div>
            @endforeach
          </div>
          @if($club->images->count() > 1)
          <a class="carousel-control-prev" href="#carouselExampleControls{{$club->id}}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls{{$club->id}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          @endif
        </div>

        <div class="card-body">
          @foreach ($users->clubs as $clubs)

          @if($clubs->id == $club->id)
          <a href="#" class="btn btn-sm btn-success disabled">Joined</a><br><br>
          @endif

          @endforeach
          <h5 class="card-title ">{{ $club->name }}</h5>
          <p class="card-text text-truncate ">{{ $club->description }}</p>
          <a href="{{ route('club.show',$club->id)}}" class="btn btn-primary">Show more</a>
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
// function myFunction() {
//   // Declare variables
//   var input, filter, table, tr, td, i, txtValue;
//   input = document.getElementById("myInput");
//   filter = input.value.toUpperCase();
//   repeat = document.getElementById("myDIV");
//   tr = table.getElementsByTagName("tr");

//   // Loop through all table rows, and hide those who don't match the search query
//   for (i = 0; i < tr.length; i++) {
//     td = tr[i].getElementsByTagName("td")[0];
//     if (td) {
//       txtValue = td.textContent || td.innerText;
//       if (txtValue.toUpperCase().indexOf(filter) > -1) {
//         tr[i].style.display = "";
//       } else {
//         tr[i].style.display = "none";
//       }
//     }
//   }
// }
</script>
@endsection
@endsection