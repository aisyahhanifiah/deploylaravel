@extends('layouts.app')

@section('title', $club->name.' |')

@section('content')
<div class="header pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      {{ Breadcrumbs::render('club.show', $club->id) }}
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
      <div class="col-md-6">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            @foreach($club->images as $key => $images)
            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
              <img class="card-img-top d-block w-100 h-50" src="{{ asset('img/club/'.$images->filename) }}" alt="ss">
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
      </div>
  </div>
  <div class="row table-responsive-md">
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
        <p>{{ $club->description }}</p>
        <hr>
        <h3 class="my-3">Details</h3>
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">Status</th>
              <td>
                          @if($checkUser == 1)
                          <a href="#" class="btn btn-sm btn-success disabled">Joined</a><br><br>
                          @else
                          <a href="#" class="btn btn-sm btn-primary disabled">Not a member</a><br><br>
                          <form method="post" action="{{ route('myclub.join') }}" autocomplete="off">
                            {{ csrf_field() }}
                          <button type="submit" class="btn btn-sm btn-warning">Join this club</button>
                          <input name="user_id" type="hidden" value="{{ Auth::user()->id }}"><br><br>
                          <input name="club_id" type="hidden" value="{{ $club->id }}">
                          <input name="position_id" type="hidden" value="6">
                          </form>
                          @endif
              </td>
            </tr>
            <tr>
              <th scope="row">Semester</th>
              <td>{{ $club->semester }}</td>
            </tr>
            <tr>
              <th scope="row">No. of members</th>
              <td>{{ $userno }}</td>
            </tr>
            <tr>
              <th scope="row">GHOCS domain</th>
              <td>{{ $domain->name }}</td>
            </tr>
            <tr>
              <th scope="row">Membership fees</th>
              <td>RM{{ number_format($club->fees,2) }}</td>
            </tr>
            <tr>
              <th scope="row">Requirement</th>
              <td>{{ $club->requirement }}</td>
            </tr>
            <tr>
              <th scope="row">Social</th>
              <td>
                @if($club->url_fb != NULL)  
                  <a class="link" href="{{ URL::to($club->url_fb) }}">
                      <i class="fab fa-1x fa-facebook-square text-success"></i>&nbsp
                  </a>&nbsp&nbsp
                @endif 
                @if($club->url_ig != NULL) 
                  <a class="link" href="{{ $club->url_ig }}">
                      <i class="fab fa-1x fa-instagram text-success"></i>&nbsp 
                  </a>&nbsp&nbsp
                @endif 
                @if($club->url_email != NULL) 
                  <a class="link" href="mailto:{{ $club->url_email }}">
                      <i class="fas fa-1x fa-envelope text-success"></i>&nbsp  {{ $club->url_email }}
                  </a>
                @endif
              </td>
            </tr>
          </tbody>
        </table>
        <hr>
        <h3 class="my-3">Committee</h3>
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">Advisor</th>
              <td>@if($advisordet!=NULL){{  $advisordet->name }}@endif<br>
                @if($advisordet!=NULL)<a class="link" href="mailto:{{ $advisordet->email }}">
                      <i class="fas fa-envelope text-success"></i>  {{ $advisordet->email }}
                  </a>@endif
              </td>
            </tr>
            <tr>
              <th scope="row">President</th>
              <td>@if($presidentdet!=NULL){{  $presidentdet->name }}@endif<br>
                @if($presidentdet!=NULL)<a class="link" href="mailto:{{ $presidentdet->email }}">
                      <i class="fas fa-envelope text-success"></i>  {{ $presidentdet->email }}
                  </a>@endif</td>
            </tr>
            <tr>
              <th scope="row">Vice President</th>
              <td>@if($vicedet!=NULL){{  $vicedet->name }}@endif<br>
                @if($vicedet!=NULL)<a class="link" href="mailto:{{ $vicedet->email }}">
                      <i class="fas fa-envelope text-success"></i>  {{ $vicedet->email }}
                  </a>@endif</td>
            </tr>
            <tr>
              <th scope="row">Secretary</th>
              <td>@if($secretarydet!=NULL){{  $secretarydet->name }}@endif<br>
                @if($secretarydet!=NULL)<a class="link" href="mailto:{{ $secretarydet->email }}">
                      <i class="fas fa-envelope text-success"></i>  {{ $secretarydet->email }}
                  </a>@endif</td>
            </tr>
            <tr>
              <th scope="row">Treasurer</th>
              <td>@if($treasurerdet!=NULL){{  $treasurerdet->name }}@endif<br>
                @if($treasurerdet!=NULL)<a class="link" href="mailto:{{ $treasurerdet->email }}">
                      <i class="fas fa-envelope text-success"></i>  {{ $treasurerdet->email }}
                  </a>@endif</td>
            </tr>
            
          </tbody>
        </table>
      </div>
  </div>

  @include('layouts.footers.auth')
</div>
@endsection