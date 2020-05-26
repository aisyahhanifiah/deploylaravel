@extends('layouts.app')

@section('title', 'Manage Clubs |')

@section('content')

<div class="header pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="col-md-12">
            <h1 class="display-2 ">Committee</h1>
        </div>
        <div class="header-body">{{ Breadcrumbs::render('committee.club.index') }}</div>
    </div>
</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div id="contacts">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="mb-0">{{ __('Manage Clubs') }}</h3>
                                <p class="mb-0">You're a committee at these clubs</p>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control search" placeholder="Search" type="text">
                                </div>     
                            </div>
                            <div class="col-md-1 text-right">

                                {{-- <a href="{{ route('committee.club.create') }}" class="btn btn-sm btn-primary inline">{{ __('Add club') }}</a> --}}
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


                    <div class="table-responsive" >
                      <table class="table table-responsive-md align-items-center">
                        <thead class="thead-light">
                          <tr>
                            <th class="sort" data-sort="name" style="cursor: pointer;">Name <span><i class="fas fa-sort"></i></span></th>
                            <th class="sort" data-sort="semester">Semester</th>
                            <th class="sort" data-sort="position_name" style="cursor: pointer;">Your Position <span><i class="fas fa-sort"></i></span></th>
                            <th class="sort" data-sort="members" style="cursor: pointer;">No. of members <span><i class="fas fa-sort"></i></span></th>
                            <th class="sort" data-sort="creation" style="cursor: pointer;">Creation Date <span><i class="fas fa-sort"></i></span></th>
                            <th>Payment</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        {{-- @foreach($userclub as $getclubid) --}}
                        {{-- @foreach ($users->clubs->where('id', '=', $getclubid->club_id) as $club) --}}
                        {{-- {{dd($clubs)}} --}}
                        @foreach($clubs as $club)

                        <tr>

                            <td class="name">{{ $club->name }}</td>
                            <td class="semester">{{ $club->semester }}</td>
                            <td class="position_name">{{ $club->position_name }}</td>
                            <td class="members"><b>{{ $userno->where('club_id', '=', $club->club_id1)->count() }}</b>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="{{ route('committee.club.member.show', $club->club_id1) }}" class="btn btn-sm btn-primary">{{ __('All members') }}</a></td>
                            <td class="creation">{{ Carbon\Carbon::parse($club->created_at)->format('d/m/Y h:iA') }}</td>
                            <td class="creation">
                                @if (is_null($club->stripe_connect_id))
                                <a href="{{ route('stripe.create', $club->club_id1) }}" class="btn btn-sm btn-warning">Stripe not connected</a>
                                @else
                                <a href="#" class="btn btn-sm btn-success">Stripe connected</a>
                                @endif 
                            </td>
                            
                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <form action="{{ route('committee.club.destroy', $club->club_id1) }}" method="post">
                                            {{ csrf_field() }}


                                            <a class="dropdown-item" href="{{ route('committee.club.edit', $club->club_id1) }}">{{ __('Edit') }}</a>

                                        </form>    
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        {{--@endforeach--}}                        
                    </tbody>
                </table>

            </div>

        </div>
                    {{-- <div class="table-responsive">
                        
                        <table class="table align-items-center" >
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" data-sort="name">{{ __('Name') }}</th>
                                    <th scope="col" data-sort="semester">{{ __('Semester') }}</th>
                                    <th scope="col" data-sort="members">{{ __('No. of members') }}</th>
                                    <th scope="col" data-sort="creation">{{ __('Creation Date') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($clubs as $club)
                                    <tr>
                                        <td class="name">{{ $club->name }}</td>
                                        <td class="semester">{{ $club->semester }}</td>
                                        <td class="members"><b>{{ $userno->where('club_id', '=', $club->id)->count() }}</b>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="{{ route('admin.club.member.show', $club) }}" class="btn btn-sm btn-primary">{{ __('All members') }}</a></td>
                                        <td  class="creation">{{ $club->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('admin.club.destroy', $club) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                            
                                                            
                                                            <a class="dropdown-item" href="{{ route('admin.club.edit', $club) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this club?") }}') ? this.parentElement.submit() : ''">
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
                    </div> --}}


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
    <script src="{{ asset('argon') }}/js/sortclub.js"></script>
    @endsection
    @endsection

