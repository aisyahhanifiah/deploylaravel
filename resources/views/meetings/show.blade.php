@extends('layouts.app')

@section('title', $event->name.' |')

@section('pagename', $event->name)
@section('breadurl', route('event.index'))
@section('bread', 'Event /')

@section('content') 
@include('layouts.headers.cards')
<div class="container-fluid mt--7">
  <div class="row">

      <div class="col-md-6">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($event->images as $key => $images)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
              <img class="card-img-top d-block w-100" src="{{ asset('img/event/'.$images->filename) }}" alt="ss">
            </div>
            @endforeach
          </div>
          @if($event->images->count() > 1)
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
      </div>

  </div>
  <div class="row">
      <div class="col-md-7">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h3 class="my-3">Description</h3>
        <p>{{ $event->description }}</p>
        <hr>
        <h3 class="my-3">Details</h3>
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">Status</th>
              <td>
                          @if($checkUser == 1)
                          <a href="#" class="btn btn-sm btn-success">Joined</a><br><br>
                          @else
                          <a href="#" class="btn btn-sm btn-primary">Not a member</a><br><br>
                          <form method="post" action="{{ route('myevent.join') }}" autocomplete="off">
                            {{ csrf_field() }}
                          <button type="submit" class="btn btn-sm btn-warning">Join this event</button>
                          <input name="user_id" type="hidden" value="{{ Auth::user()->id }}"><br><br>
                          <input name="event_id" type="hidden" value="{{ $event->id }}">
                          <input name="position_id" type="hidden" value="6">
                          </form>
                          @endif
              </td>
            </tr>
            <tr>
              <th scope="row">No. of participants</th>
              <td>{{ $userno }}</td>
            </tr>
            <tr>
              <th scope="row">Start Date</th>
              <td>{{ Carbon\Carbon::parse($event->start_date)->format('l, dS F Y, h:i A') }}</td>
            </tr>
            <tr>
              <th scope="row">End Date</th>
              <td>{{ Carbon\Carbon::parse($event->end_date)->format('l, dS F Y, h:i A') }}</td>
            </tr>
            <tr>
              <th scope="row">Venue</th>
              <td>{{ $event->venue }}</td>
            </tr>
            <tr>
              <th scope="row">Organized by</th>
              <td>{{ $club->name }}</td>
            </tr>
            <tr>
              <th scope="row">GHOCS domain</th>
              <td>{{ $domain->name }}</td>
            </tr>
            <tr>
              <th scope="row">Level</th>
              <td>{{ $level->name }}</td>
            </tr>
            <tr>
              <th scope="row">Category</th>
              <td>{{ $category->name }}</td>
            </tr>
            <tr>
              <th scope="row">Membership fees</th>
              <td>RM{{ number_format($event->fees,2) }}</td>
            </tr>
            <tr>
              <th scope="row">Requirement</th>
              <td>{{ $event->requirement }}</td>
            </tr>
            
          </tbody>
        </table>
      </div>
  </div>
  @include('layouts.footers.auth')
</div>
@endsection