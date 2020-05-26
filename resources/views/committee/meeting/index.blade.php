@extends('layouts.app')

@section('title', 'Manage Meeting |')

@section('content')
<div class="header pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="col-md-12">
            <h1 class="display-2 ">Committee</h1>
        </div>
        <div class="header-body">{{ Breadcrumbs::render('committee.meeting.index') }}</div>
    </div>
</div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">

                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Manage Meetings') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('committee.meeting.create') }}" class="btn btn-sm btn-primary">{{ __('Add meeting') }}</a>
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
                      @foreach($clubs as $club)

                        <div class="card">
                            <div class="card-header" id="headingOne{{ $club->id}}" data-toggle="collapse" data-target="#collapseOne{{ $club->id}}" aria-expanded="true" aria-controls="collapseOne{{ $club->id}}">
                                <div class="row align-items-center">
                                <div class="col-8">
                                <h5 class="mb-0">{{ $club->name}}</h5>
                              </div>
                               <div class="col-md-2 text-right">
                                    <a href="{{ route('meetingforclub.export', $club->id) }}" class="btn btn-sm btn-primary">{{ __('Generate Report') }}</a>
                                </div>
                                <div class="col-md-2 text-right">
                                    <p class="btn btn-sm btn-primary disabled mb-0">No. of meetings: {{ $meetings->where('club_id', '=', $club->id)->count() }}</p>
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
                                                  <th class="sort" data-sort="name" style="width: 20%;cursor: pointer;" scope="col">{{ __('Name') }} <span><i class="fas fa-sort"></i></span></th>
                                                <th class="sort" data-sort="time" style="cursor: pointer;" scope="col">{{ __('Time') }} <span><i class="fas fa-sort"></i></span></th>
                                    
                                                <th class="sort" data-sort="venue" style="width: 20%;cursor: pointer;" scope="col">{{ __('Venue') }} <span><i class="fas fa-sort"></i></span></th>
                                                <th class="sort" data-sort="members" style="cursor: pointer;" scope="col">{{ __('No. of participant') }} <span><i class="fas fa-sort"></i></span></th>
                                            
                                                <th scope="col"></th>

                                              </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($meetings->where('club_id', '=', $club->id) as $meeting)

                                            <tr>
                                              <td class="name text-truncate">{{ $meeting->name }}</td>
                                              <td class="time">{{ Carbon\Carbon::parse($meeting->datetime)->format('d/m/Y') }}</td>
                                              <td class="venue text-truncate">{{ $meeting->venue }}</td>
                                              <td class="members"><b>{{ $userno->where('meeting_id', '=', $meeting->id)->count() }}</b>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="{{ route('committee.meeting.member.show', $meeting) }}" class="btn btn-sm btn-primary">{{ __('All members') }}</a></td>
                                              
                                              <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('committee.meeting.destroy', $meeting) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                            
                                                            
                                                            <a class="dropdown-item" href="{{ route('committee.meeting.edit', $meeting) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this meeting?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    
                                                </div>
                                            </div>
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