@extends('layouts.app', ['title' => __('welcome')])
@section('dashboard')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Dashboard</a>
@endsection
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row pl-3 pb-4 pl-md-3 pb-md-4">
                <p class="h1 mb-0 text-white" href="">Welcome, {{ auth()->user()->name }}!</p>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Joined Clubs</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $clubs }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="ni ni-app"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ route('myclub.index') }}" class="text-success mr-2"><i class="fa fa-arrow-right"></i> View More</a>
                                {{-- <span class="text-nowrap">Since last month</span> --}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Your Participations</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $events }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="ni ni-paper-diploma"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ route('myevent.index') }}" class="text-success mr-2"><i class="fa fa-arrow-right"></i> View More</a>
                                {{-- <span class="text-nowrap">Since last week</span> --}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Meetings Attended</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $meetings }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="ni ni-collection"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ route('myclub.index') }}" class="text-success mr-2"><i class="fa fa-arrow-right"></i> View More</a>
                                {{-- <span class="text-nowrap">Since yesterday</span> --}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Pending Payment</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $totalpending }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="far fa-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-muted text-sm">
                                <a href="{{ route('payment.index') }}" class="text-success mr-2"><i class="fa fa-arrow-right"></i> View More</a>
                                {{-- <span class="text-nowrap">Since last month</span> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">All Clubs</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('club.index') }}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table table-responsive-md align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 40%;">Club</th>
                                    <th scope="col">Domain</th>
                                    <th scope="col">Total Members</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allclubs as $club)
                                <tr>
                                    <th scope="row">
                                        {{$club->name}}
                                    </th>
                                    <td>
                                        {{$club->domains->name}}
                                    </td>
                                    <td>
                                        {{$club->users_count}}
                                    </td>
                                    <td>
                                        <a href="{{ route('club.show', $club->id) }}" class="btn btn-sm btn-primary">{{ __('View More') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Latest Events</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table table-responsive-md align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" style="width: 40%;">Event</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Participants</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allevents as $event)
                                <tr>
                                    <th class="text-truncate" scope="row" >
                                        {{ $event->name }}
                                    </th>
                                    <td>
                                        {{ Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        {{$event->users_count}}
                                    </td>
                                    <td>
                                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-sm btn-primary">{{ __('View More') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush