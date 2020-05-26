@extends('layouts.app')

@section('title', 'Meetings |')

@section('pagename', 'My Meetings')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7">
  <div class="row">
    @foreach($users->clubs as $club)
    <div class="col-xl-3 col-lg-6">
      <div class="card" style="width: 18rem;">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($club->images as $key => $images)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
              <img class="card-img-top d-block w-100" src="{{ asset('img/club/'.$images->filename) }}" alt="ss">
            </div>
            @endforeach
          </div>
          @if($club->images->count() > 1)
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
          @endif
        </div>

        <div class="card-body">
          <a href="#" class="btn btn-sm btn-success">Joined</a><br><br>
          <h5 class="card-title">{{ $club->name }}</h5>
          <p class="card-text text-truncate">{{ $club->description }}</p>
          <a href="{{ route('club.show',$club->id)}}" class="btn btn-primary">Show more</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @include('layouts.footers.auth')
</div>
@endsection