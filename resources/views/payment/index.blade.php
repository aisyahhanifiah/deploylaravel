@extends('layouts.app')

@section('title', 'My Payment |')

@section('content')
<div class="header pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="col-md-12">
        </div>
        <div class="header-body">{{ Breadcrumbs::render('payment.index') }}</div>
    </div>
</div>

<div class="container-fluid mt--7">
    <div class="row pb-5">
        <div class="col">
            <div class="card shadow">
                <div id="contacts">
                    <div class="card-header table-responsive border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">{{ __('Pending Payment') }}</h3>
                            </div>
                            <div class="col-6">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control search" placeholder="Search" type="text">
                                </div>     
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>
                    <div class="col-12">
                        @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('warning') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </div>


                    <div class="table-responsive align-items-center" >
                      <table class="table table-responsive-md align-items-center ">
                        <thead class="thead-light">
                          <tr>
                            <th class="sort" data-sort="name" style="cursor: pointer;">Item Name <span><i class="fas fa-sort"></i></span></th>
                            <th class="sort" data-sort="fees" style="cursor: pointer;">Fees <span><i class="fas fa-sort"></i></span></th>
                            <th class="sort" data-sort="created_at" style="cursor: pointer;">Date <span><i class="fas fa-sort"></i></span></th>


                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($pending->stripenull as $club)
                        <tr>
                            <td class="name">{{ $club->name }}</td>
                            <td class="fees"><b>RM{{ number_format($club->fees, 2) }}</b></td>
                            <td class="created_at">{{ Carbon\Carbon::parse($club->pivot->created_at)->format('d/m/Y') }}</td>                            
                            <td class="">
                                <form action="{{route('club.purchase')}}" method="POST">
                                  {{ csrf_field() }}

                                  <input value="{{$club->id}}" name="clubid" hidden>
                                  <p> {{-- if user card exist --}}
                                  <button type="submit" class="btn btn-sm btn-warning" onclick="confirm('{{ __("Your registered card will be deducted once you click ok.") }}') ? this.parentElement.submit() : ''">
                                    {{ __('Pay Now') }}
                                </button>
                                </p>
                                </form>
                                
                            </td>
                        </tr>
                        @endforeach

                        @foreach ($pending1->stripenulleve as $event)
                        <tr>
                            <td class="name">{{ $event->name }}</td>
                            <td class="fees"><b>RM{{ number_format($event->fees, 2) }}</b></td>
                            <td class="created_at">{{ Carbon\Carbon::parse($event->pivot->created_at)->format('d/m/Y') }}</td>
                            <td class="">
                                <form action="{{route('event.purchase')}}" method="POST">
                                  {{ csrf_field() }}

                                  <input value="{{$event->id}}" name="eventid" hidden>
                                  <p>
                                  <button type="submit" class="btn btn-sm btn-warning" onclick="confirm('{{ __("Your registered card will be deducted once you click ok.") }}') ? this.parentElement.submit() : ''">
                                    {{ __('Pay Now') }}
                                </button>
                                </p>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>


        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">
            </nav>
        </div>
    </div>
</div>
</div>


<div class="row">
    <div class="col">
        <div class="card shadow">
            <div id="contacts">
                <div class="card-header table-responsive border-0">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h3 class="mb-0">{{ __('Completed Payment') }}</h3>
                        </div>
                        <div class="col-6">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control search" placeholder="Search" type="text">
                            </div>     
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


                <div class="table-responsive align-items-center" >
                  <table class="table table-responsive-md align-items-center ">
                    <thead class="thead-light">
                      <tr>
                        <th class="sort" data-sort="name" style="cursor: pointer;">Item Name <span><i class="fas fa-sort"></i></span></th>
                        <th class="sort" data-sort="fees" style="cursor: pointer;">Fees <span><i class="fas fa-sort"></i></span></th>
                        <th class="sort" data-sort="updated_at" style="cursor: pointer;">Date of Payment<span><i class="fas fa-sort"></i></span></th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($completed->stripeexist as $club)
                    <tr>

                        <td class="name">{{ $club->name }}</td>
                        <td class="fees"><b>RM{{ number_format($club->fees, 2) }}</b></td>
                        <td class="updated_at">{{ Carbon\Carbon::parse($club->pivot->updated_at)->format('d/m/Y') }}</td>
                        <td class=""> {{-- {{ dd($userclub->find($club->pivot->id))}} --}}
                            <a href="{{ route('payment.show1', $userclub->find($club->pivot->id)) }}" class="btn btn-sm btn-success">View More</a>

                        </td>
                    </tr>
                    @endforeach

                    @foreach ($completed1->stripeexisteve as $event)
                    <tr>

                        <td class="name">{{ $event->name }}</td>
                        <td class="fees"><b>RM{{ number_format($event->fees, 2) }}</b></td>
                        <td class="updated_at">{{ Carbon\Carbon::parse($userevent->find($event->pivot->id)->updated_at)->format('d/m/Y') }}</td>
                        <td class=""> {{-- {{ dd($userevent->find($event->pivot->id))}} --}}
                            <a href="{{ route('payment.show2', $userevent->find($event->pivot->id)) }}" class="btn btn-sm btn-success">View More</a>
                            
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>

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

@section('loadlist')
<script src="{{ asset('argon') }}/js/sortpayment.js"></script>
@endsection
@endsection

