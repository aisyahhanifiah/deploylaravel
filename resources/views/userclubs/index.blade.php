@extends('layouts.app')

@section('title', 'My Club |')

@section('content')

<div class="header pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
      {{ Breadcrumbs::render('myclub.index') }}
    </div>
  </div>
</div>


<div class="container-fluid mt--7">
  <div class="row">
    <div class="col">

      <div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">{{ __('My Clubs') }}</h3>
            </div>
            <div class="col-4 text-right">
              {{-- <a href="{{ route('admin.club.create') }}" class="btn btn-sm btn-primary">{{ __('Add club') }}</a> --}}
            </div>
          </div>
        </div>

        <div class="col-12">
          @if (session('status'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        </div>


        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">{{ __('Name') }}</th>
              </tr>
            </thead>

          </table>
        </div>

        <div class="accordion" id="accordionExample">
          @foreach($users->clubs as $club)

          <div class="card">
            <div class="card-header" id="headingOne{{ $club->id}}" data-toggle="collapse" data-target="#collapseOne{{ $club->id}}" aria-expanded="true" aria-controls="collapseOne{{ $club->id}}">
              <div class="row align-items-center">
                <div class="col-md-8">
                  <h5 class="mb-0">{{ $club->name}}</h5>
                </div>
                <div class="col-md-2">

                  @if (is_null($club->pivot->stripe_charge_id))

                  <form action="{{route('club.purchase')}}" method="POST">
                    {{ csrf_field() }}

                    <input value="{{$club->id}}" name="clubid" hidden>
                    <p>
                    <button type="submit" class="btn btn-sm btn-warning disabled">Club fee has not been paid</button></p>
                  </form>
                  @else
                  <p class="btn btn-sm btn-success disabled">Club fee has been paid</p>
                  @endif 
                </div>
                @php
                                  //find meeting held by club
                $countMeet = $meetings->where('club_id', '=', $club->id)->where('datetime', '<', now())->count();
                $usermeet = 0;

                                  // foreach($meetings->where('club_id', '=', $club->id) as $meeting)
                                  // {
                                  //   if($userMeeting->where('meeting_id', '=', $meeting->id)->count() == 1)
                                  //   {$usermeet++;}
                                  // }

                foreach($meetings->where('club_id', '=', $club->id) as $meeting)
                {
                  if($userMeeting->where('meeting_id', '=', $meeting->id)->where('user_id', auth()->user()->id)->count() == 1)
                    {$usermeet++;}
                }

                if ($countMeet > 0 ) {
                  $attendancePer = $usermeet/$countMeet*100;
                }
                else{
                  $attendancePer = 0;
                }
                @endphp
                <div class="col-md-2">
                  <p class="btn btn-sm btn-primary">Attendance: {{ number_format($attendancePer,1) }}%</p>
                </div>
              </div>
            </div>
            <div id="collapseOne{{ $club->id}}" class="collapse" aria-labelledby="headingOne{{ $club->id}}" data-parent="#accordionExample">
              <div class="card-body">
                <div class="table-responsive">
                  @if($meetings->where('club_id', '=', $club->id)->count() != 0)
                  <table class="table table-responsive-md align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Time') }}</th>
                        <th scope="col">{{ __('Venue') }}</th>
                        <th scope="col">{{ __('Attendance') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($meetings->where('club_id', '=', $club->id) as $meeting)


                      <tr>
                        <td>{{ $meeting->name }}</td>
                        <td>{{ Carbon\Carbon::parse($meeting->datetime)->format('d/m/Y h:iA') }}</td>
                        <td>{{ $meeting->venue }}</td>
                        <td>
                          @if($userMeeting->where('meeting_id', '=', $meeting->id)->where('user_id', auth()->user()->id)->count() == 1)
                          <h5><i class="fas fa-check text-success">&nbsp&nbsp</i>Attend</h5>
                          @elseif($userMeeting->where('meeting_id', '=', $meeting->id)->where('user_id', auth()->user()->id)->count() == 0)
                          @if(Carbon\Carbon::parse($meeting->datetime)->greaterThan(Carbon\Carbon::now()))
                          <h5>Upcoming</h5>
                          @else
                          <h5><i class="fas fa-times text-danger">&nbsp&nbsp&nbsp</i>Absent</h5>
                          @endif
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @else
                  <p>No meetings held yet.</p>
                  @endif
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>




        <div class="card-footer py-4">
          <nav class="d-flex justify-content-end" aria-label="...">
            {{-- {{ $users->links() }} --}}
          </nav>
        </div>
      </div>
    </div>
  </div>

  @include('layouts.footers.auth')
</div>
@endsection