@extends('layouts.app')

@section('title', 'Manage Events |')

@section('content')
<div class="header pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="col-md-12">
            <h1 class="display-2 ">Administrator</h1>
        </div>
        <div class="header-body">{{ Breadcrumbs::render('admin.event.index') }}</div>
    </div>
</div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div id="contacts">
                    <div class="card-header table-responsive border-0">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <h3 class="mb-0">{{ __('Events') }}</h3>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group ">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control search" placeholder="Search" type="text">
                                </div>     
                            </div>
                            <div class="col-md-2 text-md-right text-left py-2">
                                                           
                                <a href="{{ route('event.export') }}" class="btn btn-sm btn-primary inline">{{ __('Generate Report') }}</a>
                            </div>
                            <div class="col-md-1 text-md-right text-left py-2">
                                <a href="{{ route('admin.event.create') }}" class="btn btn-sm btn-primary">{{ __('Add event') }}</a>
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
                        <table class="table table-responsive-md align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="no" style="cursor: pointer;width: 7px;">No.<span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="name" style="width: 20%;cursor: pointer;" scope="col">{{ __('Name') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="startdate" style="cursor: pointer;" scope="col">{{ __('Start Date') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="enddate" style="cursor: pointer;" scope="col">{{ __('End Date') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="venue" style="width: 20%;cursor: pointer;" scope="col">{{ __('Venue') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="members" style="cursor: pointer;" scope="col">{{ __('No. of participant') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th class="sort" data-sort="creation" style="cursor: pointer;" scope="col">{{ __('Creation Date') }} <span><i class="fas fa-sort"></i></span></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="no">{{ $no=$no+1 }}</td>
                                        <td class="name text-truncate">{{ $event->name }}</td>
                                        <td class="startdate">{{ Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}</td>
                                        <td class="enddate">{{ Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</td>
                                        <td class="venue text-truncate">{{ $event->venue }}</td>
                                        <td class="members"><b>{{ $userno->where('event_id', '=', $event->id)->count() }}</b>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="{{ route('admin.event.member.show', $event) }}" class="btn btn-sm btn-primary">{{ __('Participants') }}</a></td>
                                        <td class="creation">{{ $event->created_at->format('d/m/Y h:iA') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('admin.event.destroy', $event) }}" method="post">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                            
                                                            
                                                            <a class="dropdown-item" href="{{ route('admin.event.edit', $event) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this event?") }}') ? this.parentElement.submit() : ''">
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
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{-- {{ $users->links() }} --}}
                        </nav>
                    </div>
                </div>
            </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
    @section('loadlist')
<script src="{{ asset('argon') }}/js/sortevent.js"></script>
@endsection

@endsection